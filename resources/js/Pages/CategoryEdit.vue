<template>
    <article class="bg-gray-100 w-100 h-min text-center">
        <Navbar/>
        <header class="w-1/2 m-auto">
            <div class="flex justify-between mt-8">
                <LinkButton :href="route('categories')" class="mr-2">
                    <IconArrowLeft class="mr-2"/>
                    Categories
                </LinkButton>
                <secondary-basic-button :href="route('categories.create')">
                    <IconAddOutline class="mr-2"/>
                    New Category
                </secondary-basic-button>
            </div>
        </header>
        <section class="mt-8 w-1/2 m-auto pb-10">
            <form @submit.prevent="submit" class="p-6 rounded-md bg-white border border-gray-300 shadow-neutral-500">
                <h2 class="mb-6 text-3xl text-gray-600 justify-center items-center flex space-x-6 capitalize">
                    Edit Category
                    <IconCompose class="ml-6 text-gray-500"/>
                </h2>
                <div class="grid grid-cols-1 gap-4 mb-4 text-left capitalize">
                    <div class="flex flex-col">
                        <label class="text-sm mb-2 mb-1 pl-1 font-medium text-gray-700 uppercase">Name</label>
                        <div class="text-red-500 text-xs mb-1 pl-1 normal-case" v-if="errors.name">{{ errors.name }}</div>
                        <input type="text" required
                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                               v-model="category.name"/>
                    </div>
                    <div class="flex flex-col">
                        <label class="text-sm mb-2 mb-1 pl-1 font-medium text-gray-700 uppercase">Meta Title</label>
                        <div class="text-red-500 text-xs mb-1 pl-1 normal-case" v-if="errors.meta_title">{{ errors.meta_title }}</div>
                        <input type="text" required
                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                               v-model="category.meta_title"/>
                    </div>
                    <div class="flex flex-col">
                        <label class="text-sm mb-2 mb-1 pl-1 font-medium text-gray-700 uppercase">Meta
                            Description</label>
                        <div class="text-red-500 text-xs mb-1 pl-1 normal-case" v-if="errors.meta_description">{{ errors.meta_description }}</div>
                        <input type="text" required
                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                               v-model="category.meta_description"/>
                    </div>
                    <div class="flex flex-col">
                        <label class="text-sm mb-2 mb-1 pl-1 font-medium text-gray-700 uppercase">Meta Keywords</label>
                        <div class="text-red-500 text-xs mb-1 pl-1 normal-case" v-if="errors.meta_keywords">{{ errors.meta_keywords }}</div>
                        <input type="text" required
                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                               v-model="category.meta_keywords"/>
                    </div>
                </div>

                <div class="flex justify-center mt-8">
                    <PrimaryBasicButton @click="updateCategory" class="" :class="{ 'opacity-25': deleting || saving }" :disabled="deleting || saving">
                        <IconSaveDisk class="mr-2"/>
                        Save
                    </PrimaryBasicButton>
                    <button @click="deleteCategory" class="font-semibold text-white px-4 py-2 rounded-md hover:shadow-neutral-400 hover:bg-red-500 flex justify-center items-center ml-6 bg-red-600 text-white" :class="{ 'opacity-25': deleting || saving }" :disabled="deleting || saving" >
                        <IconTrash class="mr-2"/>
                        DELETE
                    </button>
                </div>

            </form>
        </section>
    </article>
</template>

<script>
import Navbar from "@/Pages/ui/Navbar.vue";
import LinkButton from "@/Pages/ui/LinkButton.vue";
import {Link} from "@inertiajs/vue3";
import PrimaryBasicButton from "@/Pages/ui/PrimaryBasicButton.vue";
import SecondaryBasicButton from "@/Pages/ui/SecondaryBasicButton.vue";
import {router} from "@inertiajs/vue3";
import {
    IconAddOutline,
    IconSaveDisk,
    IconArrowLeft,
    IconCompose,
    IconTrash
} from '@iconify-prerendered/vue-zondicons'

export default {
    name: "CategoryEdit",

    components: {
        Navbar,
        Link,
        LinkButton,
        PrimaryBasicButton,
        SecondaryBasicButton,
        IconAddOutline,
        IconSaveDisk,
        IconArrowLeft,
        IconCompose,
        IconTrash
    },

    props: {
        category: {
            type: Object,
        },
        errors: {
            type: Object
        }
    },
    data: () => ({
        saving: false,
        deleting: false
    }),

    methods: {
        updateCategory() {
            this.saving = true
            router.patch(`/categories/${this.category.id}/update`, this.category, {
                onFinish: () => { this.saving = false }
            })
        },
        deleteCategory(){
            this.deleting = true
            router.delete(`/categories/${this.category.id}`, {
                onFinish: ()=> { this.deleting = false}
            })
        }
    },
}
</script>

