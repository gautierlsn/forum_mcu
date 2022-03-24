
<div class="header pb-4 comment_tilte text-center" style="padding-top: 5%;">
    <h3>Poster un commentaire</h3>
</div>
<div class="container">
    <div class="align-items-center">
        <form action="../Script_PHP/do_add_comment.php" method="POST">
            <input type="hidden" value="<?=$idTopic?>" name="idTopic">
            <textarea name="contenu" required id="editor1" class="form-control"></textarea>
            <div class="mx-auto text-center" style="padding-top: 1%">
                <input type="submit" name="submit" class="btn btn-warning">
            </div>
        </form>
    </div>
</div>





<script>
    CKEDITOR.replace('editor1', {
        // Define the toolbar groups as it is a more accessible solution.
        toolbarGroups: [{
            "name": "basicstyles",
            "groups": ["basicstyles"]
        },
            {
                "name": "links",
                "groups": ["links"]
            },
            {
                "name": "paragraph",
                "groups": ["list", "blocks"]
            },
            {
                "name": "document",
                "groups": ["mode"]
            },
            {
                "name": "insert",
                "groups": ["insert"]
            },
            {
                "name": "styles",
                "groups": ["styles"]
            },
            {
                "name": "about",
                "groups": ["about"]
            }
        ],
        // Remove the redundant buttons from toolbar groups defined above.
        removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar,PasteFromWord,Image'
    });
</script>
