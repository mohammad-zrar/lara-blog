import './bootstrap';
import '../css/app.css'
import Editor from '@toast-ui/editor';
import 'codemirror/lib/codemirror.css';
import '@toast-ui/editor/dist/toastui-editor.css';

// Initialize Toast UI Editor
document.addEventListener("DOMContentLoaded", () => {
    const editorElement = document.querySelector('#editor');
    if (editorElement) {
        const editor = new Editor({
            el: editorElement,
            height: '400px',
            initialEditType: 'markdown',
            placeholder: 'Write something cool!',
        });

        // Synchronize editor content with the hidden textarea on form submission
        const form = document.querySelector('#create-post-form');
        if (form) {
            form.addEventListener('submit', (e) => {
                document.querySelector('#content').value = editor.getMarkdown();
            });
        }
    }
});


