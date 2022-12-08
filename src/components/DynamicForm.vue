<script setup>
import { Form, Field, ErrorMessage, defineRule } from "vee-validate";
import { ref } from "vue";

const props = defineProps({
  schema: {
    type: Object,
    required: true,
  },
});

const toggle = ref(false);

const onSubmit = (values) => {
  console.log(JSON.stringify(values, null, 2));
};

const schemas = {
  name: "required",
  ruby: "required",
  email: "required|email",
  confirmation: `required|confirmed:@email`,
  tel: "required|tel",
  note: "required",
};

defineRule("required", (value) => {
  if (!value || !value.length) {
    return "入力必須項目です";
  }
  return true;
});

defineRule("minLength", (value, [limit]) => {
  if (value.length < limit) {
    return `This field must be at least ${limit} characters`;
  }
  return true;
});

defineRule("email", (value) => {
  // Check if email
  const regex = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
  if (!regex.test(value)) {
    return "正しいメールアドレスを入れてください";
  }
  return true;
});

defineRule("confirmed", (value, [email]) => {
  if (value !== email) {
    return "メールアドレスと一致しません";
  }
  return true;
});

defineRule("tel", (int) => {
  const regex = /^[0-9]+$/;
  if (!regex.test(int)) {
    return "電話番号を入力してください";
  }
  return true;
});
</script>
<template>
  <Form @submit="onSubmit" :validation-schema="schemas">
    <dl class="contact-table">
      <dl v-for="field in schema" :key="field.name">
        <dt :for="field.name">{{ field.label }}</dt>
        <dd>
          <transition name="fade" appear>
            <ErrorMessage :name="field.name" />
          </transition>
          <Field :as="field.as" :id="field.name" :name="field.name" />
        </dd>
      </dl>
    </dl>
    <button>Submit</button>
  </Form>
</template>
