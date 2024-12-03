<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $orderColumn = request('order_column', 'created_at');

        if (! in_array($orderColumn, ['id', 'title', 'content', 'created_at'])) {
            $orderColumn = 'created_at';
        }
        $orderDirection = request('order_direction', 'desc');

        if (! in_array($orderDirection, ['asc', 'desc'])) {
            $orderColumn = 'desc';
        }


        $posts = Post::with('category', 'users', 'media')
            ->when(request('search_category'), function (Builder $query) {
                $query->where('category_id', request('search_category'));
            })
            ->when(request('search_id'), function (Builder $query) {
                $query->where('id', request('search_id'));
            })
            ->when(request('search_title'), function (Builder $query) {
                $query->where('title', 'like', '%' . request('search_title') . '%');
            })
            ->when(request('search_content'), function (Builder $query) {
                $query->where('content', 'like', '%' . request('search_content') . '%');
            })
            ->when(request('search_global'), function (Builder $query) {
                $query->whereAny([
                    'id',
                    'title',
                    'content',
                ], 'LIKE', '%' . request('search_global') . '%');
            })

            ->orderBy($orderColumn, $orderDirection)
            ->paginate(10);
        $posts->each(function ($post) use ($user) {
            $post->users = $post->users->contains($user);
            $post->images = $post->getFirstMedia();
        });
        return PostResource::collection($posts);
    }
    public function upload(StorePostRequest $request, Post $post)
    {
        $request->validate(['file' => 'required|file|mimes:jpg,jpeg,png,gif,mp4']);
        $post->addMedia($request->file('file'))->toMediaCollection();

        return response()->json(['message' => 'Media uploaded successfully.']);
    }
    public function getMedia(Post $post)
    {
        return response()->json($post->getMedia()->map(fn($media) => $media->getUrl()));
    }
    public function store(StorePostRequest $request)
    {
        Gate::authorize('posts.create');

        $validated = $request->validated();

        $post = Post::create($validated);

        if ($request->hasFile('image')) {
            $post->addMedia($request->file('image'))->toMediaCollection();
        }

        return new PostResource($post);
    }

    public function show(Post $post)
    {
        return new PostResource($post);
    }

    public function update(Post $post, StorePostRequest $request)
    {
        Gate::authorize('posts.update');

        $post->update($request->validated());
        if ($request->hasFile('image')) {
            $post->addMedia($request->file('image'))->toMediaCollection();
            $post->images = $post->getFirstMedia();
        }


        return new PostResource($post);
    }

    public function destroy(Post $post)
    {
        Gate::authorize('posts.delete');
        $post->users()->detach();
        $post->delete();
        return response()->noContent();
    }
    public function toggleLike(Post $post)
    {
        $user = Auth::user();

        if ($post->users()->where('user_id', $user->id)->exists()) {
            // If liked, unlike
            $post->users()->detach($user->id);
        } else {
            // If not liked, like
            $post->users()->attach($user->id);
        }
        $post->likes_count = 1;

        return response()->noContent();
    }
}
