<!-- CKEditor 5 Rich Text Editor (Free Version) -->
<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
<style>
    .ck-editor__editable {
        min-height: 400px;
    }
    .ck.ck-editor__main>.ck-editor__editable:not(.ck-focused) {
        border-color: #dee2e6;
    }
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    ClassicEditor
        .create(document.querySelector('textarea[name="content"]'), {
            toolbar: [
                'heading', '|', 
                'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 
                'outdent', 'indent', '|', 
                'imageUpload', 'blockQuote', 'insertTable', 'mediaEmbed', '|', 
                'undo', 'redo', 'code'
            ],
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h2', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h3', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h4', title: 'Heading 3', class: 'ck-heading_heading3' }
                ]
            }
        })
        .then(editor => {
            console.log('CKEditor 5 initialized');
            
            const textarea = document.querySelector('textarea[name="content"]');
            const form = textarea.closest('form');
            
            if (form) {
                form.addEventListener('submit', () => {
                    const data = editor.getData();
                    textarea.value = data;
                });
            }

            // Also sync on change (optional, for real-time)
            editor.model.document.on('change:data', () => {
                const data = editor.getData();
                textarea.value = data;
            });
        })
        .catch(error => {
            console.error('Error initializing CKEditor 5:', error);
            // Fallback to basic textarea is automatically handled by CKEditor not loading
        });
});
</script>
