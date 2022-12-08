<script setup>
import DynamicForm from "./components/DynamicForm.vue";
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
    name: "post-code",
    as: "input",
  },
  {
    label: "ご住所",
    name: "address",
    as: "input",
  },
  {
    label: "※お問い合わせ内容",
    name: "note",
    as: "textarea",
  },
]);
</script>

<template>
  <DynamicForm :schema="formSchema" />
</template>
