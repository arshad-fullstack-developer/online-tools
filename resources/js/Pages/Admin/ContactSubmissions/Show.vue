<template>
    <AdminLayout>
        <Head :title="submission ? `Contact from ${submission.name}` : 'Contact Submission'" />

        <div class="mb-6">
            <Link :href="route('admin.contact-submissions.index')" class="inline-flex items-center text-gray-600 hover:text-gray-900 mb-4">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Submissions
            </Link>
            <h1 class="text-3xl font-bold text-gray-900">Contact Submission</h1>
        </div>

        <div v-if="!submission" class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
            <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h2 class="text-xl font-bold text-gray-900 mb-2">Submission Not Found</h2>
            <p class="text-gray-600 mb-6">The contact submission you're looking for doesn't exist.</p>
            <Link :href="route('admin.contact-submissions.index')" class="inline-flex items-center px-6 py-3 bg-primary-600 text-white rounded-xl font-semibold hover:bg-primary-700">
                Back to Submissions
            </Link>
        </div>

        <div v-if="submission" class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
                    <!-- Subject -->
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ submission.subject }}</h2>
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            {{ formatDate(submission.created_at) }}
                        </div>
                    </div>

                    <!-- Message -->
                    <div class="mb-6">
                        <h3 class="text-sm font-semibold text-gray-700 uppercase tracking-wider mb-3">Message</h3>
                        <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                            <p class="text-gray-800 whitespace-pre-wrap leading-relaxed">{{ submission.message }}</p>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex flex-wrap gap-3 pt-6 border-t border-gray-200">
                        <button @click="showEmailModal = true" 
                                class="inline-flex items-center px-6 py-3 bg-primary-600 text-white rounded-xl font-semibold hover:bg-primary-700 transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Reply via Email
                        </button>
                        
                        <button v-if="!submission.is_read" @click="markAsRead" 
                                class="inline-flex items-center px-6 py-3 bg-green-600 text-white rounded-xl font-semibold hover:bg-green-700 transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Mark as Read
                        </button>

                        <button v-else @click="markAsUnread" 
                                class="inline-flex items-center px-6 py-3 bg-gray-600 text-white rounded-xl font-semibold hover:bg-gray-700 transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Mark as Unread
                        </button>

                        <button @click="deleteSubmission" 
                                class="inline-flex items-center px-6 py-3 bg-red-600 text-white rounded-xl font-semibold hover:bg-red-700 transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Delete
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Contact Info -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Contact Information</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Name</label>
                            <p class="text-gray-900 font-medium mt-1">{{ submission.name }}</p>
                        </div>

                        <div>
                            <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Email</label>
                            <button @click="copyEmail" class="text-primary-600 hover:text-primary-700 font-medium mt-1 block text-left hover:underline">
                                {{ submission.email }}
                            </button>
                        </div>

                        <div>
                            <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</label>
                            <div class="mt-1">
                                <span v-if="!submission.is_read" class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-orange-100 text-orange-800">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <circle cx="10" cy="10" r="4"></circle>
                                    </svg>
                                    Unread
                                </span>
                                <span v-else class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 20 20">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Read
                                </span>
                            </div>
                        </div>

                        <div>
                            <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Received</label>
                            <p class="text-gray-900 mt-1">{{ formatDate(submission.created_at) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-gradient-to-br from-primary-500 to-primary-700 rounded-xl shadow-xl p-6 text-white">
                    <h3 class="text-lg font-bold mb-4">Quick Actions</h3>
                    <div class="space-y-3">
                        <button @click="showEmailModal = true" class="block w-full px-4 py-3 bg-white/20 hover:bg-white/30 rounded-lg text-center font-medium transition-colors">
                            Compose Email
                        </button>
                        <button @click="copyEmail" class="block w-full px-4 py-3 bg-white/20 hover:bg-white/30 rounded-lg text-center font-medium transition-colors">
                            {{ emailCopied ? '✓ Email Copied!' : 'Copy Email' }}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Email Modal -->
        <div v-if="showEmailModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4" @click="showEmailModal = false">
            <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto" @click.stop>
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h2 class="text-2xl font-bold text-gray-900">Reply via Email</h2>
                        <button @click="showEmailModal = false" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="p-6 space-y-6">
                    <!-- Email Details -->
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">To:</label>
                            <div class="flex items-center gap-2">
                                <input type="text" :value="submission.email" readonly class="flex-1 px-4 py-2 border border-gray-300 rounded-lg bg-gray-50">
                                <button @click="copyToClipboard(submission.email, 'emailCopied')" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg text-sm font-medium">
                                    {{ copied.emailCopied ? '✓' : 'Copy' }}
                                </button>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Subject:</label>
                            <div class="flex items-center gap-2">
                                <input type="text" :value="`Re: ${submission.subject}`" readonly class="flex-1 px-4 py-2 border border-gray-300 rounded-lg bg-gray-50">
                                <button @click="copyToClipboard(`Re: ${submission.subject}`, 'subjectCopied')" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg text-sm font-medium">
                                    {{ copied.subjectCopied ? '✓' : 'Copy' }}
                                </button>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Message Template:</label>
                            <div class="relative">
                                <textarea :value="emailTemplate" readonly rows="10" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 font-mono text-sm"></textarea>
                                <button @click="copyToClipboard(emailTemplate, 'messageCopied')" class="absolute top-2 right-2 px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg text-sm font-medium">
                                    {{ copied.messageCopied ? '✓ Copied' : 'Copy Template' }}
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Open in Email Client Options -->
                    <div class="border-t border-gray-200 pt-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Open in Email Client:</h3>
                        <div class="grid grid-cols-2 gap-3">
                            <a :href="gmailUrl" target="_blank" class="flex items-center justify-center gap-2 px-4 py-3 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 5.457v13.909c0 .904-.732 1.636-1.636 1.636h-3.819V11.73L12 16.64l-6.545-4.91v9.273H1.636A1.636 1.636 0 0 1 0 19.366V5.457c0-2.023 2.309-3.178 3.927-1.964L5.455 4.64 12 9.548l6.545-4.91 1.528-1.145C21.69 2.28 24 3.434 24 5.457z"/>
                                </svg>
                                Open in Gmail
                            </a>
                            <a :href="outlookUrl" target="_blank" class="flex items-center justify-center gap-2 px-4 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M7.88 12.04q0 .45-.11.87-.1.41-.33.74-.22.33-.58.52-.37.2-.87.2t-.85-.2q-.35-.21-.57-.55-.22-.33-.33-.75-.1-.42-.1-.86t.1-.87q.1-.43.34-.76.22-.34.59-.54.36-.2.87-.2t.86.2q.35.21.57.55.22.34.31.77.1.43.1.88zM24 12v9.38q0 .46-.33.8-.33.32-.8.32H7.13q-.46 0-.8-.33-.32-.33-.32-.8V18H1q-.41 0-.7-.3-.3-.29-.3-.7V7q0-.41.3-.7Q.58 6 1 6h6.5V2.55q0-.44.3-.75.3-.3.75-.3h12.9q.44 0 .75.3.3.3.3.75V10.85l1.24.72h.01q.1.07.18.18.07.12.07.25zm-6-8.25v3h3v-3zm0 4.5v3h3v-3zm0 4.5v1.83l3.05-1.83zm-5.25-9v3h3.75v-3zm0 4.5v3h3.75v-3zm0 4.5v2.03l2.41 1.5 1.34-.8v-2.73zM9 3.75V6h2l.13.01.12.04v-2.3zM5.98 15.98q.9 0 1.6-.3.7-.32 1.19-.86.48-.55.73-1.28.25-.74.25-1.61 0-.83-.25-1.55-.24-.71-.71-1.24t-1.15-.83q-.68-.3-1.55-.3-.92 0-1.64.3-.71.3-1.2.85-.5.54-.75 1.3-.25.74-.25 1.63 0 .85.26 1.56.26.72.74 1.23.48.52 1.17.81.69.3 1.56.3zM7.5 21h12.39L12 16.08V17q0 .41-.3.7-.29.3-.7.3H7.5zm15-.13v-7.24l-5.9 3.54Z"/>
                                </svg>
                                Open in Outlook
                            </a>
                        </div>
                        <p class="text-sm text-gray-600 mt-3 text-center">Or copy the details above and paste into your preferred email client</p>
                    </div>
                </div>

                <div class="p-6 bg-gray-50 border-t border-gray-200">
                    <button @click="showEmailModal = false" class="w-full px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white rounded-xl font-semibold transition-colors">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';

const props = defineProps({
    submission: Object,
});

const showEmailModal = ref(false);
const emailCopied = ref(false);
const copied = ref({
    emailCopied: false,
    subjectCopied: false,
    messageCopied: false
});

const emailTemplate = computed(() => {
    return `Hi ${props.submission.name},

Thank you for contacting us. 

[Your reply here]

----
Original Message:
${props.submission.message}`;
});

const gmailUrl = computed(() => {
    const subject = `Re: ${props.submission.subject}`;
    const body = emailTemplate.value;
    return `https://mail.google.com/mail/?view=cm&fs=1&to=${encodeURIComponent(props.submission.email)}&su=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;
});

const outlookUrl = computed(() => {
    const subject = `Re: ${props.submission.subject}`;
    const body = emailTemplate.value;
    return `https://outlook.live.com/mail/0/deeplink/compose?to=${encodeURIComponent(props.submission.email)}&subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;
});

const formatDate = (dateString) => {
    if (!dateString) return 'N/A';
    try {
        const date = new Date(dateString);
        return date.toLocaleDateString('en-US', { 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
    } catch (e) {
        return 'Invalid Date';
    }
};

const copyToClipboard = async (text, field) => {
    try {
        await navigator.clipboard.writeText(text);
        copied.value[field] = true;
        setTimeout(() => {
            copied.value[field] = false;
        }, 2000);
    } catch (err) {
        alert('Failed to copy: ' + err);
    }
};

const copyEmail = async () => {
    try {
        await navigator.clipboard.writeText(props.submission.email);
        emailCopied.value = true;
        setTimeout(() => {
            emailCopied.value = false;
        }, 2000);
    } catch (err) {
        alert('Failed to copy email: ' + err);
    }
};

const markAsRead = () => {
    router.post(route('admin.contact-submissions.mark-read', props.submission.id));
};

const markAsUnread = () => {
    router.post(route('admin.contact-submissions.mark-unread', props.submission.id));
};

const deleteSubmission = () => {
    if (confirm('Are you sure you want to delete this submission?')) {
        router.delete(route('admin.contact-submissions.destroy', props.submission.id), {
            onSuccess: () => {
                router.visit(route('admin.contact-submissions.index'));
            }
        });
    }
};
</script>
