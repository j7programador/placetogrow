<script setup>
import {Head, Link} from '@inertiajs/vue3';
import MicrositeCard from "@/Components/MicrositeCard.vue";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    microsites: {
        type: Array,
    }
});

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
}

const Actions = "Actions";

</script>

<template>
    <Head title="Welcome"/>
    <div class="bg-gray-50 text-black/50 dark:bg-gray-900 dark:text-white/50">
        <div>
            <div v-if="$page.props.flash.success" class="bg-green-400">
                <div class="max-w-7xl mx-auto py-3 px-3 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between flex-wrap">
                        <div class="w-0 flex-1 flex items-center">
                            <p class="ml-3 font-medium text-white truncate">
                                <span class="md:hidden"> {{ $page.props.flash.success }} </span>
                                <span class="hidden md:inline">
                {{ $page.props.flash.success }}
              </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div>
                <div v-if="$page.props.flash.danger" class="bg-red-400">
                    <div class="max-w-7xl mx-auto py-3 px-3 sm:px-6 lg:px-8">
                        <div class="flex items-center justify-between flex-wrap">
                            <div class="w-0 flex-1 flex items-center">
                                <p class="ml-3 font-medium text-white truncate">
                                    <span class="md:hidden"> {{ $page.props.flash.danger }} </span>
                                    <span class="hidden md:inline">
                {{ $page.props.flash.danger }}
              </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white"
        >
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                    <div class="flex lg:justify-center lg:col-start-2">
                        PayMicro
                    </div>
                    <nav v-if="canLogin" class="-mx-3 flex flex-1 justify-end">
                        <Link
                            v-if="$page.props.auth.user"
                            :href="route('dashboard')"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >
                            Dashboard
                        </Link>

                        <template v-else>
                            <Link
                                :href="route('login')"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Log in
                            </Link>

                        </template>
                    </nav>
                </header>

                <main class="max-w-6xl mx-auto mt-6 min-h-screen">
                    <section class="bg-gray-200 dark:bg-gray-900 dark:text-white mt-4 p-2 rounded">
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-8 rounded">
                            <div v-for="microsite in microsites" :key="microsite.id">
                                <MicrositeCard>
                                    <Link :href="`/microsite/${microsite.slug}`">
                                        <div class="aspect-w-2 aspect-h-3">
                                            <img class="h-32 w-64 sm:h-50 sm:w-100 flex-none rounded-md bg-gray-50"
                                                 :src="microsite.img_url" alt="">
                                            <p class="text-gray-600">{{microsite.type_microsite}}</p>
                                        </div>
                                    </Link>
                                </MicrositeCard>
                                <p class="text-gray-300">{{ microsite.name }}</p>
                            </div>
                        </div>
                    </section>
                </main>

                <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                    {{ " Simple Payments, Simple Living" }} ( V{{ 1.0 }})
                </footer>
            </div>
        </div>
    </div>
</template>
