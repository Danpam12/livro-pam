<script setup>

import { useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
    'livro': {}
})

const form = useForm({
    'titulo': props.livro.titulo,
    'autor': props.livro.autor,
    'genero': props.livro.genero,
    'ano': props.livro.ano
})

const updateLivro = () => {
    form.patch(route('livro.update', props.livro.id), {
        onFinish: () => {
            alert('Feito!')
        }
    })
}

</script>

<template>
    <AuthenticatedLayout>
        <div>
            <h1>Aqui vai o formulário</h1>
            <form @submit.prevent="updateLivro" class="border p-2">
                <div @click="showForm = !showForm" class="cursor-pointer">x</div>
                <div class="grid grid-cols-2">
                    <label>Título</label>
                    <TextInput class="border p-2" v-model="form.titulo" />
                </div>
                <div class="grid grid-cols-2">
                    <label>Autor</label>
                    <TextInput class="border p-2" v-model="form.autor" />
                </div>
                <div class="grid grid-cols-2">
                    <label>Gênero</label>
                    <TextInput class="border p-2" v-model="form.genero" />
                </div>
                <div class="grid grid-cols-2">
                    <label>Ano</label>
                    <TextInput class="border p-2" v-model="form.ano" />
                </div>
                <PrimaryButton type="submit">Enviar</PrimaryButton>
            </form>
        </div>
    </AuthenticatedLayout>
</template>