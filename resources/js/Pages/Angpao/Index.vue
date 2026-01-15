<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

const props = defineProps({ poolId: String });
const page = usePage();

const form = useForm({
    name: '',
    voucher_code: '',
});

const isProcessing = ref(false);
const showResult = ref(false);

const successData = computed(() => page.props.flash?.success);
const errorData = computed(() => page.props.flash?.error);

const submitClaim = () => {
    isProcessing.value = true;
    form.post(route('angpao.claim', props.poolId), {
        onSuccess: () => {
            isProcessing.value = false;
            if (successData.value) showResult.value = true;
        },
        onError: () => {
            isProcessing.value = false;
        }
    });
};
</script>

<template>
    <div class="min-h-screen bg-[#4a0404] flex flex-col items-center justify-center p-6 font-sans antialiased text-slate-100 overflow-hidden relative">
        
        <div class="absolute top-0 left-0 w-full h-full bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-red-900/20 via-transparent to-transparent"></div>
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-yellow-600/10 blur-[100px] rounded-full"></div>

        <div class="w-full max-w-lg z-10">
            <div class="text-center mb-10 space-y-2 animate-fade-in">
                <p class="text-yellow-500 font-serif text-5xl mb-2 drop-shadow-md">福</p>
                <h1 class="text-2xl font-light tracking-[0.4em] uppercase text-yellow-100/90">
                    The Lunar <span class="font-bold text-yellow-500">Privilege</span>
                </h1>
                <div class="h-px w-20 bg-gradient-to-r from-transparent via-yellow-600 to-transparent mx-auto mt-4"></div>
            </div>

            <div v-if="!showResult" class="space-y-8 animate-slide-up">
                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-[2.5rem] p-8 md:p-12 shadow-2xl shadow-black/50 relative group">
                    
                    <div class="absolute top-4 right-4 text-yellow-600/30 text-4xl">🧧</div>

                    <div class="space-y-6">
                        <div class="text-center space-y-1">
                            <h3 class="text-xl font-medium text-yellow-200">Buka Keberuntungan</h3>
                            <p class="text-sm text-slate-400">Silahkan isi detail untuk mengklaim Angpao Anda</p>
                        </div>

                        <div class="space-y-4">
                            <div class="relative">
                                <input 
                                    v-model="form.name"
                                    type="text" 
                                    placeholder="Nama Lengkap"
                                    class="w-full bg-black/40 border border-white/5 rounded-2xl py-4 px-6 text-white placeholder-slate-500 focus:outline-none focus:ring-1 focus:ring-yellow-500/50 transition-all text-lg"
                                />
                            </div>

                            <div class="relative">
                                <input 
                                    v-model="form.voucher_code"
                                    type="text" 
                                    placeholder="Kode Voucher Marketing"
                                    class="w-full bg-black/40 border border-white/5 rounded-2xl py-4 px-6 text-white placeholder-slate-500 focus:outline-none focus:ring-1 focus:ring-yellow-500/50 transition-all text-lg uppercase tracking-widest font-mono"
                                />
                            </div>
                        </div>

                        <div v-if="errorData || form.errors.name || form.errors.voucher_code" 
                             class="text-red-400 text-center text-sm font-medium bg-red-950/30 py-3 rounded-xl border border-red-900/20">
                            {{ errorData || form.errors.name || form.errors.voucher_code }}
                        </div>

                        <button 
                            @click="submitClaim"
                            :disabled="isProcessing || !form.name || !form.voucher_code"
                            class="w-full bg-gradient-to-tr from-yellow-700 via-yellow-400 to-yellow-600 py-5 rounded-2xl shadow-xl hover:shadow-yellow-500/10 active:scale-[0.98] transition-all disabled:opacity-20 disabled:grayscale group relative overflow-hidden"
                        >
                            <span class="relative z-10 text-[#4a0404] font-black text-lg tracking-widest uppercase">
                                {{ isProcessing ? 'Memverifikasi...' : 'Klaim Sekarang' }}
                            </span>
                            <div class="absolute inset-0 bg-white/20 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-1000"></div>
                        </button>
                    </div>
                </div>
            </div>

            <div v-else class="animate-reveal text-center space-y-12">
                <div class="relative inline-block">
                    <div class="absolute inset-0 bg-yellow-400 blur-[80px] opacity-20 rounded-full animate-pulse"></div>
                    
                    <div class="relative bg-gradient-to-b from-yellow-100 to-yellow-500 p-[2px] rounded-full shadow-2xl">
                        <div class="bg-[#4a0404] rounded-full w-64 h-64 md:w-80 md:h-80 flex flex-col items-center justify-center border-4 border-yellow-900/30">
                            <p class="text-yellow-500 text-sm font-bold tracking-widest uppercase mb-2">Anda Mendapatkan</p>
                            <h2 class="text-white text-4xl md:text-5xl font-black">
                                <span class="text-lg text-yellow-600">Rp</span> 
                                {{ successData.amount.toLocaleString('id-ID') }}
                            </h2>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <p class="text-yellow-100 text-2xl italic font-serif opacity-80">"{{ successData.message }}"</p>
                    <button @click="showResult = false; form.name = ''; form.voucher_code = ''" 
                            class="text-yellow-600 border-b border-transparent hover:border-yellow-600 transition-all pb-1 text-sm tracking-widest uppercase font-bold">
                        Kembali Beranda
                    </button>
                </div>
            </div>
        </div>
        
        <div class="absolute bottom-10 text-slate-500 text-[10px] tracking-[0.5em] uppercase pointer-events-none">
            &copy; 2026 Privilege Group
        </div>
    </div>
</template>

<style scoped>
@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}
.animate-fade-in { animation: fadeIn 1.5s ease-out forwards; }

@keyframes slideUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-slide-up { animation: slideUp 1s cubic-bezier(0.16, 1, 0.3, 1) forwards; }

@keyframes reveal {
    0% { transform: scale(0.8); opacity: 0; }
    100% { transform: scale(1); opacity: 1; }
}
.animate-reveal { animation: reveal 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; }
</style>