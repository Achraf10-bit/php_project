<form action="{{ route('categories.store') }}" method="POST">
    @csrf
    <label for="name">Category Name:</label>
    <input type="text" name="name" id="name" required>
    
    <label for="description">Description:</label>
    <textarea name="description" id="description"></textarea>
    
    <button type="submit">Add Category</button>
</form>