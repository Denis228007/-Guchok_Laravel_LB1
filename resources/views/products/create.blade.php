@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white fw-bold">Додати новий тур</div>

                <div class="card-body">
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Назва туру</label>
                            <input type="text" name="name" class="form-control" required placeholder="Наприклад: Карпати 3 дні">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ціна (грн)</label>
                            <input type="number" name="price" class="form-control" required placeholder="1500">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Опис</label>
                            <textarea name="description" class="form-control" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Фотографія</label>
                            <input type="file" name="image" class="form-control" required>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('products.index') }}" class="btn btn-secondary">Скасувати</a>
                            <button type="submit" class="btn btn-success">Зберегти тур</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
