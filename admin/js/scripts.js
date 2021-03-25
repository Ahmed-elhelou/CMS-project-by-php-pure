ClassicEditor
.create( document.querySelector( '#body' ) )
.catch( error => {
    console.error( error );
} );

$(document).ready(function(){
    $('#checkAll').click(function(e){
        if(this.checked){
            $('.selectPost').each(function(){
                this.checked = true;
            });
        }else{
            $('.selectPost').each(function(){
                this.checked = false;
            });
        }
    });
});
