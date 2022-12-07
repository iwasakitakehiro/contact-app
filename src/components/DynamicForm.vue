<script setup>
import { Form, Field, ErrorMessage } from "vee-validate";
import { ref } from "vue";

const props = defineProps({
  schema: {
    type: Object,
    required: true,
  },
});
const schema = ref(props.schema);
</script>
<template>
  <Form>
    <dl class="contact-table">
      <dl v-for="field in schema" :key="field.name">
        <dt :for="field.name">{{ field.label }}</dt>
        <dd><Field :as="field.as" :id="field.name" :name="field.name" /></dd>
      </dl>
    </dl>
    <button>Submit</button>
  </Form>
</template>
