@extends('layouts.site')

@section('title', $category['title'].' | SophData')
@section('meta_description', $category['short_description'].' Compare os pacotes Essencial, Profissional e Completo.')

@section('content')
    <x-site.category-page :category="$category" :portal="$portal" :faq="$faq" />
@endsection
