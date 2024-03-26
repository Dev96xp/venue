//Slug automático
document.getElementById("name").addEventListener('keyup', slugChange);

function slugChange(){
    
    name = document.getElementById("name").value;
    document.getElementById("slug").value = slug(name);

}

function slug (str) {
    var $slug = '';
    var trimmed = str.trim(str);
    $slug = trimmed.replace(/[^a-z0-9-]/gi, '-').
    replace(/-+/g, '-').
    replace(/^-|-$/g, '');
    return $slug.toLowerCase();
}