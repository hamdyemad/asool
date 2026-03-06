@extends('front.layout')

@section('title', 'أصول الزراعة - حلول ري وزراعة ذكية ومستدامة')
@section('meta_description', 'اكتشف أحدث تقنيات الري الذكي والزراعة المستدامة مع أصول الزراعة (SOOL). نقدم مشاريع زراعية متكاملة، استشارات، وأنظمة ري حديثة في السعودية.')
@section('meta_keywords', 'أصول الزراعة, ري ذكي, زراعة مستدامة, أنظمة ري حديثة, SOOL Agriculture, مشاريع زراعية, السعودية, استشارات زراعية')
@section('canonical_url', url('/'))
@section('og_title', 'أصول الزراعة - الرائدة في حلول الري والزراعة')
@section('og_description', 'شريكك الموثوق لتطوير مشاريع زراعية متكاملة ومستدامة باستخدام أحدث التكنولوجيا.')


@section('content')

    @include('front.components.hero')

    @include('front.components.partnership')

    @include('front.components.agents')

    @include('front.components.about')

    @include('front.components.services')

    @include('front.components.sustainable')

    @include('front.components.markets')

    @include('front.components.products')

    @include('front.components.partners')

    @include('front.components.contact')

@endsection
