@extends('layout')
@section('content')
<div class="bg-grey p-4 m-4">
    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">ISBN</th>
            <th scope="col">Title</th>
            <th scope="col">Language</th>
            <th scope="col">Author</th>
            <th scope="col">Publisher</th>
            <th scope="col">Edit/Delete</th>
          </tr>
        </thead>
        <tbody id="books">
        </tbody>
      </table>
</div>
<script>
    $( document ).ready(function() {
        var access_token=Cookies.get('access_token');
        console.log(access_token);
$.ajax({
    type: 'GET',
    url: "{{url('api/books')}}",
    contentType: 'application/json',
    dataType: 'JSON',
    headers: {
        'Access-Control-Allow-Origin': '*',
        'Access-Control-Allow-Methods': '*',
        'Access-Control-Allow-Headers': '*',
        },
    beforeSend: function (xhr) {
      xhr.setRequestHeader('Authorization', "Bearer"+access_token);
    },
    success: function(response){
        var output ='';
        for (var i in response.books)
            {
                console.log(response.books[i].isbn);
                output +="<tr>";
                output +='<th scope="row">'+response.books[i].id+'</th>';
                output +='<td>'+response.books[i].isbn+'</td>';
                output +='<td>'+response.books[i].title+'</td>';
                output +='<td>'+response.books[i].language+'</td>';
                output +='<td>'+response.books[i].author+'</td>';
                output +='<td>'+response.books[i].publisher+'</td>';
                output +='<td><a href="'+response.books[i].id+'">Edit</a></td>';
                output +='<tr>';
            }
            $('#books').html(output);
    },
});
});
</script>
@endsection
