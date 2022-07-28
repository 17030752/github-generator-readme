<?php 
use d17030752\Github\models\Generator;
require_once 'src/models/Generator.php';
$readme =null;
if (count($_POST) >0) {
    # code...
    $readme = new Generator($_POST);
    $readme->generate();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="src/resources/main.css">
</head>
<body>
    <h1>home</h1>
    <form action="" method="post">
        <details>
            <summary>title</summary>
                <div>
                    <input type="text" name="title" id="" 
                    value="<?php echo Generator::getValue($readme,'getTitle'); ?>">
                </div>
        </details>
        <details>
            <summary>description</summary>
                <div>
                    <input type="text" name="description" id="" 
                    value="<?php echo Generator::getValue($readme,'getDescription'); ?>">
                </div>
        </details>
        <details>
            <summary>Authors</summary>
            <div>
                <?php $authors =Generator::getValue($readme,'getAuthors');
                if (is_array($authors)) {
                    # code...
                    foreach ($authors as $author) {
                        # code...
                        ?>
                    <div class="author">
                        <input type="text" name="authors[]" id="" 
                        value="<?php echo $author['author'];?>">
                        <input type="url" name="author_links[]" id="" 
                        value="<?php echo $author['link'];?>">
                    </div>
                    <?php 
                }
            }else{
                ?>
                    <div>
                    <input type="text" name="authors[]" id="" 
                        value="">
                        <input type="url" name="author_links[]" id="" 
                        value="">
                    </div>
<?php 
}
?>
<div id="moreAuthors">

</div>
<button id="bAddAuthor">Add Author</button>                    
            </div>    
        </details>
        <input type="submit" value="Generate markdown">
    </form>
    <div class="markdown">
        <pre><code><?php 
        if (isset($readme)) {
            # code...
            echo $readme->getMarkdown();
        }
        ?></code></pre>
    </div>
    <div class="preview">
    <?php if(isset($readme)){
        echo $readme->getHTML();
    }
    ?>
    </div>
    <script>
const bAddAuthor = document.querySelector('#bAddAuthor');
bAddAuthor.addEventListener('click',e=>{
    e.preventDefault();
    const authorDiv =document.createElement('div');
    authorDiv.classList.add('author');
    const authorInput =document.createElement('input');
    authorInput.name='authors[]';

    const linkInput=document.createElement('input');
    linkInput.name='author_links[]';
    linkInput.type='url';
    authorDiv.appendChild(authorInput);
    authorDiv.appendChild(linkInput);
    document.querySelector('#moreAuthors').appendChild(authorDiv);

})

    </script>
</body>
</html>