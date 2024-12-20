
import "./bootstrap";

import { createApp, onMounted } from "vue";

import router from "./routes/index";

import VueSweetalert2 from "vue-sweetalert2";
import useAuth from "./composables/auth";
import { abilitiesPlugin } from "@casl/vue";
import ability from "./services/ability";
import { createI18n } from "vue-i18n";
import english from "@langs/en.js";
import arabic from "@langs/ar.js";


const i18n = createI18n({
    legacy: false,
    locale: "ar",
    fallbackLocale: "en",
    messages: {
        en:english.messages,
        ar:arabic.messages
    },
});

createApp({
    setup() {
        const { getUser } = useAuth();
        onMounted(getUser);
    },
})
    .use(router)
    .use(VueSweetalert2)
    .use(abilitiesPlugin, ability)
    .use(i18n)
    .mount("#app");
