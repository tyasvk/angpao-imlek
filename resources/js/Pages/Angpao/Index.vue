<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

const props = defineProps({ poolId: String });
const page = usePage();

const form = useForm({ name: '' });
const isClaiming = ref(false);
const showResult = ref(false);

const successData = computed(() => page.props.flash.success);
const errorData = computed(() => page.props.flash.error);

const submitClaim = () => {
    isClaiming.value = true;
    form.post(route('angpao.claim', props.poolId), {
        onSuccess: () => {
            isClaiming.value = false;
            if (successData.value) showResult.value = true;
        },
        onError: () => {
            isClaiming.value = false;
        }
    });
};
</script>

<template>
    <div class="min-h-screen bg-red-800 flex flex-col items-center justify-center p-6 font-sans text-white">
        
        <div class="absolute top-4 left-4 text-4xl opacity-50">🏮</div>
        <div class="absolute top-4 right-4 text-4xl opacity-50">🏮</div>

        <div class="w-full max-w-sm text-center">
            <h1 class="text-3xl font-black text-yellow-400 mb-2 drop-shadow-md">恭喜发财</h1>
            <p class="text-yellow-200 mb-8 tracking-widest uppercase text-sm">Gong Xi Fa Cai</p>

            <div v-if="!showResult" class="space-y-6">
                <div :class="{'shake-animation': isClaiming}" class="relative mx-auto w-48 h-64 bg-red-600 border-4 border-yellow-500 rounded-xl shadow-2xl flex items-center justify-center overflow-hidden">
                    <div class="absolute top-0 w-full h-1/2 bg-red-700 border-b-4 border-yellow-500 rounded-b-3xl"></div>
                    <div class="z-10 bg-yellow-500 text-red-700 w-16 h-16 rounded-full flex items-center justify-center font-bold text-2xl border-4 border-yellow-200">
                        福
                    </div>
                </div>

                <div class="mt-8">
                    <input 
                        v-model="form.name"
                        type="text" 
                        placeholder="Tulis namamu di sini..." 
                        class="w-full p-4 rounded-full bg-red-900 border-2 border-yellow-600 text-white placeholder-red-300 focus:outline-none focus:border-yellow-400 text-center text-lg"
                    />
                    <p v-if="errorData" class="text-yellow-400 mt-2 font-bold animate-pulse">{{ errorData }}</p>
                </div>

                <button 
                    @click="submitClaim"
                    :disabled="isClaiming || !form.name"
                    class="w-full bg-yellow-500 hover:bg-yellow-400 disabled:bg-gray-500 text-red-900 font-black py-4 rounded-full shadow-xl text-xl transition-all transform active:scale-90"
                >
                    {{ isClaiming ? 'MENGAMBIL...' : 'BUKA ANGPAO' }}
                </button>
            </div>

            <div v-else class="animate-fade-in">
                <div class="bg-yellow-500 p-8 rounded-3xl border-8 border-yellow-200 shadow-2xl transform rotate-3">
                    <p class="text-red-800 font-bold uppercase tracking-tighter">Selamat!</p>
                    <h2 class="text-red-700 text-4xl font-black my-4">
                        Rp {{ successData.amount.toLocaleString('id-ID') }}
                    </h2>
                    <p class="text-red-800 italic">{{ successData.message }}</p>
                </div>

                <button 
                    @click="showResult = false; form.name = ''" 
                    class="mt-10 text-yellow-400 font-bold border-b-2 border-yellow-400 pb-1"
                >
                    Coba Lagi
                </button>
            </div>
        </div>
    </div>
</template>

<style scoped>
.shake-animation {
    animation: shake 0.5s infinite;
}

@keyframes shake {
    0% { transform: translate(1px, 1px) rotate(0deg); }
    10% { transform: translate(-1px, -2px) rotate(-1deg); }
    20% { transform: translate(-3px, 0px) rotate(1deg); }
    30% { transform: translate(3px, 2px) rotate(0deg); }
    40% { transform: translate(1px, -1px) rotate(1deg); }
    50% { transform: translate(-1px, 2px) rotate(-1deg); }
    60% { transform: translate(-3px, 1px) rotate(0deg); }
    70% { transform: translate(3px, 1px) rotate(-1deg); }
    80% { transform: translate(-1px, -1px) rotate(1deg); }
    90% { transform: translate(1px, 2px) rotate(0deg); }
    100% { transform: translate(1px, -2px) rotate(-1deg); }
}

.animate-fade-in {
    animation: fadeIn 0.8s ease-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: scale(0.8); }
    to { opacity: 1; transform: scale(1); }
}
</style>