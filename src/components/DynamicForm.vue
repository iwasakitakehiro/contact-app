<script setup>
import { Form, Field, ErrorMessage, defineRule } from "vee-validate";
import { ref, onMounted } from "vue";

const props = defineProps({
  schema: {
    type: Object,
    required: true,
  },
});
const onSubmit = (values) => {
  // Fetch APIでデータ送信
  fetch("../mailer.php", {
    // 送信先URL
    method: "post", // 通信メソッド
    headers: {
      "Content-Type": "application/json", // JSON形式のデータのヘッダー
    },
    body: JSON.stringify(values, null, 2), // JSON形式のデータ
  })
    .then((response) => response.text())
    .then((data) => {
      console.log(data);
    });
};

const schemas = {
  name: "required",
  // ruby: "required",
  email: "required|email",
  // confirmation: `required|confirmed:@email`,
  // tel: "required|tel",
  // note: "required",
};

// 郵便番号自動入力
// const getPostCode = onMounted(async (int) => {
//   const reg = /^\d{7}$/;
//   if (!reg.test(int)) return;
//   try {
//     const response = await axios.get(
//       "http://zipcloud.ibsnet.co.jp/api/search",
//       {
//         params: {
//           zipcode: int,
//         },
//       }
//     );
//     const address =
//       response.data.results[0].address1 +
//       response.data.results[0].address2 +
//       response.data.results[0].address3;
//     post.value = address;
//   } catch (error) {
//     console.log(error);
//   }
// });

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
  const regex = /^0[0-9]{9,10}$/;
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
