<template>
    <div class="rich-text-editor">
        <!-- Toolbar -->
        <div v-if="editor" class="border-2 border-gray-200 rounded-t-xl bg-gray-50 p-2 flex flex-wrap gap-1">
            <!-- Text Formatting -->
            <button
                @click="editor.chain().focus().toggleBold().run()"
                :class="{ 'bg-primary-100 text-primary-700': editor.isActive('bold') }"
                class="p-2 rounded hover:bg-gray-200 transition-colors"
                type="button"
                title="Bold"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 4h8a4 4 0 014 4 4 4 0 01-4 4H6z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 12h9a4 4 0 014 4 4 4 0 01-4 4H6z"></path>
                </svg>
            </button>

            <button
                @click="editor.chain().focus().toggleItalic().run()"
                :class="{ 'bg-primary-100 text-primary-700': editor.isActive('italic') }"
                class="p-2 rounded hover:bg-gray-200 transition-colors"
                type="button"
                title="Italic"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 4h4M14 20h-4M15 4L9 20"></path>
                </svg>
            </button>

            <button
                @click="editor.chain().focus().toggleStrike().run()"
                :class="{ 'bg-primary-100 text-primary-700': editor.isActive('strike') }"
                class="p-2 rounded hover:bg-gray-200 transition-colors"
                type="button"
                title="Strikethrough"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12h18M9 5l6 14M15 5L9 19"></path>
                </svg>
            </button>

            <div class="w-px h-6 bg-gray-300 mx-1"></div>

            <!-- Headings -->
            <button
                @click="editor.chain().focus().toggleHeading({ level: 1 }).run()"
                :class="{ 'bg-primary-100 text-primary-700': editor.isActive('heading', { level: 1 }) }"
                class="px-3 py-2 rounded hover:bg-gray-200 transition-colors font-bold"
                type="button"
                title="Heading 1"
            >
                H1
            </button>

            <button
                @click="editor.chain().focus().toggleHeading({ level: 2 }).run()"
                :class="{ 'bg-primary-100 text-primary-700': editor.isActive('heading', { level: 2 }) }"
                class="px-3 py-2 rounded hover:bg-gray-200 transition-colors font-bold"
                type="button"
                title="Heading 2"
            >
                H2
            </button>

            <button
                @click="editor.chain().focus().toggleHeading({ level: 3 }).run()"
                :class="{ 'bg-primary-100 text-primary-700': editor.isActive('heading', { level: 3 }) }"
                class="px-3 py-2 rounded hover:bg-gray-200 transition-colors font-bold"
                type="button"
                title="Heading 3"
            >
                H3
            </button>

            <button
                @click="editor.chain().focus().setParagraph().run()"
                :class="{ 'bg-primary-100 text-primary-700': editor.isActive('paragraph') }"
                class="px-3 py-2 rounded hover:bg-gray-200 transition-colors"
                type="button"
                title="Paragraph"
            >
                P
            </button>

            <div class="w-px h-6 bg-gray-300 mx-1"></div>

            <!-- Lists -->
            <button
                @click="editor.chain().focus().toggleBulletList().run()"
                :class="{ 'bg-primary-100 text-primary-700': editor.isActive('bulletList') }"
                class="p-2 rounded hover:bg-gray-200 transition-colors"
                type="button"
                title="Bullet List"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>

            <button
                @click="editor.chain().focus().toggleOrderedList().run()"
                :class="{ 'bg-primary-100 text-primary-700': editor.isActive('orderedList') }"
                class="p-2 rounded hover:bg-gray-200 transition-colors"
                type="button"
                title="Numbered List"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h18M3 10h18M3 16h18"></path>
                </svg>
            </button>

            <button
                @click="editor.chain().focus().toggleBlockquote().run()"
                :class="{ 'bg-primary-100 text-primary-700': editor.isActive('blockquote') }"
                class="p-2 rounded hover:bg-gray-200 transition-colors"
                type="button"
                title="Quote"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                </svg>
            </button>

            <div class="w-px h-6 bg-gray-300 mx-1"></div>

            <!-- Alignment -->
            <button
                @click="editor.chain().focus().setTextAlign('left').run()"
                :class="{ 'bg-primary-100 text-primary-700': editor.isActive({ textAlign: 'left' }) }"
                class="p-2 rounded hover:bg-gray-200 transition-colors"
                type="button"
                title="Align Left"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h10M4 18h16"></path>
                </svg>
            </button>

            <button
                @click="editor.chain().focus().setTextAlign('center').run()"
                :class="{ 'bg-primary-100 text-primary-700': editor.isActive({ textAlign: 'center' }) }"
                class="p-2 rounded hover:bg-gray-200 transition-colors"
                type="button"
                title="Align Center"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M7 12h10M4 18h16"></path>
                </svg>
            </button>

            <button
                @click="editor.chain().focus().setTextAlign('right').run()"
                :class="{ 'bg-primary-100 text-primary-700': editor.isActive({ textAlign: 'right' }) }"
                class="p-2 rounded hover:bg-gray-200 transition-colors"
                type="button"
                title="Align Right"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M10 12h10M4 18h16"></path>
                </svg>
            </button>

            <div class="w-px h-6 bg-gray-300 mx-1"></div>

            <!-- Link -->
            <button
                @click="setLink"
                :class="{ 'bg-primary-100 text-primary-700': editor.isActive('link') }"
                class="p-2 rounded hover:bg-gray-200 transition-colors"
                type="button"
                title="Add Link"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                </svg>
            </button>

            <!-- Code Block -->
            <button
                @click="editor.chain().focus().toggleCodeBlock().run()"
                :class="{ 'bg-primary-100 text-primary-700': editor.isActive('codeBlock') }"
                class="p-2 rounded hover:bg-gray-200 transition-colors"
                type="button"
                title="Code Block"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                </svg>
            </button>

            <div class="w-px h-6 bg-gray-300 mx-1"></div>

            <!-- Undo/Redo -->
            <button
                @click="editor.chain().focus().undo().run()"
                :disabled="!editor.can().undo()"
                class="p-2 rounded hover:bg-gray-200 transition-colors disabled:opacity-30"
                type="button"
                title="Undo"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                </svg>
            </button>

            <button
                @click="editor.chain().focus().redo().run()"
                :disabled="!editor.can().redo()"
                class="p-2 rounded hover:bg-gray-200 transition-colors disabled:opacity-30"
                type="button"
                title="Redo"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 10h-10a8 8 0 00-8 8v2m18-10l-6 6m6-6l-6-6"></path>
                </svg>
            </button>
        </div>

        <!-- Editor Content -->
        <editor-content 
            :editor="editor" 
            class="prose prose-sm max-w-none border-2 border-t-0 border-gray-200 rounded-b-xl p-4 min-h-[300px] focus:outline-none"
        />
    </div>
</template>

<script setup>
import { useEditor, EditorContent } from '@tiptap/vue-3';
import StarterKit from '@tiptap/starter-kit';
import Link from '@tiptap/extension-link';
import TextAlign from '@tiptap/extension-text-align';
import { watch } from 'vue';

const props = defineProps({
    modelValue: {
        type: String,
        default: '',
    },
});

const emit = defineEmits(['update:modelValue']);

const editor = useEditor({
    content: props.modelValue,
    extensions: [
        StarterKit,
        Link.configure({
            openOnClick: false,
        }),
        TextAlign.configure({
            types: ['heading', 'paragraph'],
        }),
    ],
    onUpdate: ({ editor }) => {
        emit('update:modelValue', editor.getHTML());
    },
});

watch(() => props.modelValue, (value) => {
    const isSame = editor.value.getHTML() === value;
    if (isSame) {
        return;
    }
    editor.value.commands.setContent(value, false);
});

const setLink = () => {
    const previousUrl = editor.value.getAttributes('link').href;
    const url = window.prompt('URL', previousUrl);

    if (url === null) {
        return;
    }

    if (url === '') {
        editor.value.chain().focus().extendMarkRange('link').unsetLink().run();
        return;
    }

    editor.value.chain().focus().extendMarkRange('link').setLink({ href: url }).run();
};
</script>

<style>
.ProseMirror {
    outline: none;
}

.ProseMirror p.is-editor-empty:first-child::before {
    color: #adb5bd;
    content: attr(data-placeholder);
    float: left;
    height: 0;
    pointer-events: none;
}

.ProseMirror h1 {
    font-size: 2em;
    font-weight: bold;
    margin-top: 0.5em;
    margin-bottom: 0.5em;
}

.ProseMirror h2 {
    font-size: 1.5em;
    font-weight: bold;
    margin-top: 0.5em;
    margin-bottom: 0.5em;
}

.ProseMirror h3 {
    font-size: 1.25em;
    font-weight: bold;
    margin-top: 0.5em;
    margin-bottom: 0.5em;
}

.ProseMirror ul,
.ProseMirror ol {
    padding-left: 1.5em;
    margin: 0.5em 0;
}

.ProseMirror blockquote {
    border-left: 3px solid #ddd;
    padding-left: 1em;
    margin-left: 0;
    font-style: italic;
}

.ProseMirror code {
    background-color: #f3f4f6;
    padding: 0.2em 0.4em;
    border-radius: 0.25em;
    font-family: monospace;
}

.ProseMirror pre {
    background-color: #1f2937;
    color: #f3f4f6;
    padding: 1em;
    border-radius: 0.5em;
    overflow-x: auto;
}

.ProseMirror pre code {
    background: none;
    padding: 0;
    color: inherit;
}

.ProseMirror a {
    color: #3b82f6;
    text-decoration: underline;
}
</style>
