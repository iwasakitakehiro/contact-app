<script setup>
import { Form, Field, ErrorMessage, defineRule } from "vee-validate";
import { ref } from "vue";

const props = defineProps({
  schema: {
    type: Object,
    required: true,
  },
});

const onSubmit = (values) => {
  console.log(JSON.stringify(values, null, 2));
};

const schemas = {
  name: "required",
  ruby: "required",
  email: "required|email",
  confirmation: "required",
  tel: "required",
  note: "required",
};

defineRule("required", (value) => {
  if (!value || !value.length) {
    return "入力必須項目です";
  }
  return true;
});

defineRule("minLength", (value, [limit]) => {
  if (!value || !value.length) {
    return "This field is required";
  }
  if (value.length < limit) {
    return `This field must be at least ${limit} characters`;
  }
  return true;
});

defineRule("email", (value) => {
  // Check if email
  const regex = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
  if (!regex.test(value)) {
    return "This field must be a valid email";
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
          <ErrorMessage :name="field.name" v-slot="{ message }">
            <transition appear>
              <span :key="field.name">{{ message }}</span>
            </transition>
          </ErrorMessage>
          <Field :as="field.as" :id="field.name" :name="field.name" />
        </dd>
      </dl>
    </dl>
    <button>Submit</button>
  </Form>
</template>
