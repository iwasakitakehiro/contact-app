<script setup>
import ContactForm from "./components/ContactForm.vue";
import Compleate from "./components/Compleate.vue";
import { ref } from "vue";

const formSchema = ref([
  {
    label: "※お名前",
    name: "name",
    as: "input",
  },
  {
    label: "※ふりがな",
    name: "ruby",
    as: "input",
  },
  {
    label: "※メールアドレス",
    name: "email",
    as: "input",
  },
  {
    label: "※確認用メールアドレス",
    name: "confirmation",
    as: "input",
  },
  {
    label: "※電話番号",
    name: "tel",
    as: "input",
  },
  {
    label: "郵便番号",
    name: "postcode",
    as: "input",
  },
  {
    label: "ご住所",
    name: "address",
    as: "input",
    value: "",
  },
  {
    label: "※お問い合わせ内容",
    name: "note",
    as: "textarea",
  },
]);

const submited = ref(true);
const clickEvent = () => {
  if (submited.value) {
    submited.value = false;
  } else {
    submited.value = true;
  }
};
</script>

<template>
  <main>
    <h1>Contact</h1>
    <p>フォームはvuejsを使って実装し、メールはphpによって送信されます。</p>
    <div class="contact-wrap">
      <transition name="fade">
        <ContactForm
          @handle-event="clickEvent"
          v-if="submited"
          :schema="formSchema"
        />
        <Compleate v-else />
      </transition>
    </div>
  </main>
</template>
