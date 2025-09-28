<template>
<label class=" flex flex-col gap-1">
    <span :class="{ 'required': required }">{{ title }}</span>
    <input
        :placeholder="placeholder"
        :type="type"
        :name="name"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        :required="required"
    />
</label>

</template>

<script setup>
const props = defineProps({
  name: {
    type: String,
    required: true
  },
  title: {
    type: String,
    required: true
  },
  required: {
    type: Boolean,
    default: false
  },
  type: {
    type: String,
    default: 'text',
    validator: (value) => ['text', 'email', 'password', 'tel', 'number', 'url'].includes(value)
  },
  placeholder: {
    type: String,
    default: ''
  },
  modelValue: {
    type: String,
    default: ''
  }
});

defineEmits(['update:modelValue']);

</script>
<style  scoped>
span{
    font-family: var(--font-family);
    font-weight: 400;
    font-size: 13px;
    color: var(--blue-500);
}
input{
    border: 1px solid var(--blue-600);
    border-radius: 1000px;
    padding: 12px 20px;
    height: 43px;
    font-family: var(--font-family);
    font-weight: 400;
    font-size: 16px;
    color: var(--blue-500);
}
input::placeholder{
    font-family: var(--font-family);
    font-weight: 400;
    font-size: 16px;
    color: var(--white-400);
}
.required::after{
    content: '*';
    font-family: var(--font-family);
    font-weight: 400;
    font-size: 16px;
    color: var(--red-500);
    padding-left: 2px;
}

</style>