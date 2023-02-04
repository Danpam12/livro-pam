<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps({
    livros: {}
});

const showForm = ref(false)

const form = useForm({
    'titulo': '',
    'autor': '',
    'genero': '',
    'ano': ''
});

const addLivro = () => {
    form.post(route('livro.store'), {
        onFinish: () => {
            form.titulo = ''
            form.autor = ''
            form.genero = ''
            form.ano = ''
        }
    })
}

const removeLivro = (id) => {
    if (!confirm('Tem certeza que deseja excluir o livro?')) return
    useForm({}).delete(route('livro.destroy', id), {
        onFinish: () => {
            alert('Livro Excluído')
        }
    })
}
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">Veja aqui seus livros</div>
                    <table>
                        <tr>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Gênero</th>
                            <th>ano</th>
                        </tr>
                        <tr v-for="livro of livros" :key="livros.id">
                            <td>{{ livro.titulo }}</td>
                            <td>{{ livro.autor }}</td>
                            <td>{{ livro.genero }}</td>
                            <td>{{ livro.ano }}</td>
                            <td>
                                <button @click="removeLivro(livro.id)">Remover</button>
                                <Link :href="route('livro.edit', livro.id)">Editar</Link>
                            </td>
                        </tr>
                    </table>

                    <button 
                    class="w-full bg-green-200 p-4" 
                    @click="showForm = !showForm"
                    v-if="!showForm"
                    >Adicionar</button>
                    
                    <form v-if="showForm" @submit.prevent="addLivro" class="border p-2">
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
            </div>
        </div>
    </AuthenticatedLayout>
</template>
