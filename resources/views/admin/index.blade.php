@extends('adminlte::page')

@section('title', 'Asistencias - Panel de Control')

@section('content_header')
<div class="d-flex justify-content-between align-items-center px-3 py-4">
    <div>
        <h1 class="m-0">
            ¡Bienvenido, {{ Auth::user()->name }}!
            <small class="text-muted d-block font-weight-normal" style="font-size: 1rem;">
                {{ \Carbon\Carbon::now()->locale('es')->translatedFormat('l, d \d\e F \d\e Y') }}
            </small>
        </h1>
    </div>
    
</div>
@stop

@section('content')
<div>
    <h1>Hola</h1>
    {{-- Minimal --}}
    <x-adminlte-callout>Minimal example</x-adminlte-callout>

    {{-- themes --}}
    <x-adminlte-callout theme="info" title="Information">
        Info theme callout!
    </x-adminlte-callout>
    <x-adminlte-callout theme="success" title="Success">
        Success theme callout!
    </x-adminlte-callout>
    <x-adminlte-callout theme="warning" title="Warning">
        Warning theme callout!
    </x-adminlte-callout>
    <x-adminlte-callout theme="danger" title="Danger">
        Danger theme callout!
    </x-adminlte-callout>
</div>
<div>
    {{-- Minimal with a title / no body --}}
    <x-adminlte-card title="A card without body"/>

    {{-- Minimal without header / body only --}}
    <x-adminlte-card theme="lime" theme-mode="outline">
        A card without header...
    </x-adminlte-card>

    {{-- Disabled --}}
    <x-adminlte-card title="Disabled Card" theme="teal" disabled>
        A disabled card with teal theme...
    </x-adminlte-card>

    {{-- Themes --}}
    <x-adminlte-card title="Dark Card" theme="dark" icon="fas fa-lg fa-moon">
        A dark theme card...
    </x-adminlte-card>
    <x-adminlte-card title="Lightblue Card" theme="lightblue" theme-mode="outline"
        icon="fas fa-lg fa-envelope" header-class="text-uppercase rounded-bottom border-info"
        removable>
        A removable card with outline lightblue theme...
    </x-adminlte-card>
    <x-adminlte-card title="Purple Card" theme="purple" icon="fas fa-lg fa-fan" removable collapsible>
        A removable and collapsible card with purple theme...
    </x-adminlte-card>
    <x-adminlte-card title="Success Card" theme="success" theme-mode="full" icon="fas fa-lg fa-thumbs-up"
        collapsible="collapsed">
        A collapsible card with full success theme and collapsed...
    </x-adminlte-card>
    <x-adminlte-card title="Info Card" theme="info" icon="fas fa-lg fa-bell" collapsible removable maximizable>
        An info theme card with all the tool buttons...
    </x-adminlte-card>

    {{-- Complex / Extra tool / Footer --}}
    <x-adminlte-card title="Form Card" theme="maroon" theme-mode="outline"
        class="elevation-3" body-class="bg-maroon" header-class="bg-light"
        footer-class="bg-maroon border-top rounded border-light"
        icon="fas fa-lg fa-bell" collapsible removable maximizable>
        <x-slot name="toolsSlot">
            <select class="custom-select w-auto form-control-border bg-light">
                <option>Skin 1</option>
                <option>Skin 2</option>
                <option>Skin 3</option>
            </select>
        </x-slot>
        <x-adminlte-input name="User" placeholder="Username"/>
        <x-adminlte-input name="Pass" type="password" placeholder="Password"/>
        <x-slot name="footerSlot">
            <x-adminlte-button class="d-flex ml-auto" theme="light" label="submit"
                icon="fas fa-sign-in"/>
        </x-slot>
    </x-adminlte-card>
</div>

<div>
    {{-- Minimal with title, text and icon --}}
    <x-adminlte-info-box title="Title" text="some text" icon="far fa-lg fa-star"/>

    {{-- Themes --}}
    <x-adminlte-info-box title="Views" text="424" icon="fas fa-lg fa-eye text-dark" theme="gradient-teal"/>

    <x-adminlte-info-box title="Downloads" text="1205" icon="fas fa-lg fa-download" icon-theme="purple"/>

    <x-adminlte-info-box title="528" text="User Registrations" icon="fas fa-lg fa-user-plus text-primary"
        theme="gradient-primary" icon-theme="white"/>

    <x-adminlte-info-box title="Tasks" text="75/100" icon="fas fa-lg fa-tasks text-orange" theme="warning"
        icon-theme="dark" progress=75 progress-theme="dark"
        description="75% of the tasks have been completed"/>

    {{-- Updatable --}}
    <x-adminlte-info-box title="Reputation" text="0/1000" icon="fas fa-lg fa-medal text-dark"
        theme="danger" id="ibUpdatable" progress=0 progress-theme="teal"
        description="0% reputation completed to reach next level"/>
</div>
<div>
    {{-- Minimal with a name --}}
    <x-adminlte-profile-widget name="User Name"/>

    {{-- Themes --}}
    <x-adminlte-profile-widget name="John Doe" desc="Administrator" theme="teal"
        img="https://picsum.photos/id/1/100">
        <x-adminlte-profile-col-item title="Followers" text="125" url="#"/>
        <x-adminlte-profile-col-item title="Following" text="243" url="#"/>
        <x-adminlte-profile-col-item title="Posts" text="37" url="#"/>
    </x-adminlte-profile-widget>

    <x-adminlte-profile-widget name="Sarah O'Donell" desc="Commercial Manager" theme="primary"
        img="https://picsum.photos/id/1011/100">
        <x-adminlte-profile-col-item class="text-primary border-right" icon="fas fa-lg fa-gift"
            title="Sales" text="25" size=6 badge="primary"/>
        <x-adminlte-profile-col-item class="text-danger" icon="fas fa-lg fa-users" title="Dependents"
            text="10" size=6 badge="danger"/>
    </x-adminlte-profile-widget>

    <x-adminlte-profile-widget name="Robert Gleeis" desc="Sound Manager" theme="warning"
        img="https://picsum.photos/id/304/100" header-class="text-left" footer-class="bg-gradient-dark">
        <x-adminlte-profile-col-item title="I'm also" text="Artist" size=3
            class="text-orange border-right border-warning"/>
        <x-adminlte-profile-col-item title="Loves" text="Music" size=6
            class="text-orange border-right border-warning"/>
        <x-adminlte-profile-col-item title="Like to" text="Travel" size=3
            class="text-orange"/>
    </x-adminlte-profile-widget>

    <x-adminlte-profile-widget name="Alice Viorich" desc="Community Manager" theme="purple"
        img="https://picsum.photos/id/454/100" footer-class="bg-gradient-pink">
        <x-adminlte-profile-col-item icon="fab fa-2x fa-instagram" text="Instagram" badge="purple" size=4/>
        <x-adminlte-profile-col-item icon="fab fa-2x fa-facebook" text="Facebook" badge="purple" size=4/>
        <x-adminlte-profile-col-item icon="fab fa-2x fa-twitter" text="Twitter" badge="purple" size=4/>
    </x-adminlte-profile-widget>

    {{-- Custom --}}
    <x-adminlte-profile-widget class="elevation-4" name="Willian Dubling" desc="Web Developer"
        img="https://picsum.photos/id/177/100" cover="https://picsum.photos/id/541/550/200"
        header-class="text-white text-right" footer-class='bg-gradient-dark'>
        <x-adminlte-profile-row-item title="4+ years of experience with"
            class="text-center border-bottom border-secondary"/>
        <x-adminlte-profile-col-item title="Javascript" icon="fab fa-2x fa-js text-orange" size=3/>
        <x-adminlte-profile-col-item title="PHP" icon="fab fa-2x fa-php text-orange" size=3/>
        <x-adminlte-profile-col-item title="HTML5" icon="fab fa-2x fa-html5 text-orange" size=3/>
        <x-adminlte-profile-col-item title="CSS3" icon="fab fa-2x fa-css3 text-orange" size=3/>
        <x-adminlte-profile-col-item title="Angular" icon="fab fa-2x fa-angular text-orange" size=4/>
        <x-adminlte-profile-col-item title="Bootstrap" icon="fab fa-2x fa-bootstrap text-orange" size=4/>
        <x-adminlte-profile-col-item title="Laravel" icon="fab fa-2x fa-laravel text-orange" size=4/>
    </x-adminlte-profile-widget>
</div>
<div>

</div>
<div>

</div>
@stop

@push('js')
<script>

    $(document).ready(function() {

        let iBox = new _AdminLTE_InfoBox('ibUpdatable');

        let updateIBox = () =>
        {
            // Update data.
            let rep = Math.floor(1000 * Math.random());
            let idx = rep < 100 ? 0 : (rep > 500 ? 2 : 1);
            let progress = Math.round(rep * 100 / 1000);
            let text = rep + '/1000';
            let icon = 'fas fa-lg fa-medal ' + ['text-primary', 'text-light', 'text-warning'][idx];
            let description = progress + '% reputation completed to reach next level';

            let data = {text, icon, description, progress};
            iBox.update(data);
        };

        setInterval(updateIBox, 5000);
    })

</script>
@endpush