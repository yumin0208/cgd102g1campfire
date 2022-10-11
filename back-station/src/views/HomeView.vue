<template>

<Main></Main>
<!-- <Details></Details> -->
<!-- <Form></Form> -->

</template>

<script>
// @ is an alias to /src
import Main from '@/components/Main.vue';
import Details from '@/components/Details.vue';
import Form from '@/components/Form.vue';

export default {
  name: 'HomeView',
  components: {
    Main,
    Details,
    Form
}
}
</script>
