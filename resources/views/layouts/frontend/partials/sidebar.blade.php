<!-- Introduction menu -->
<div class="w3-col l4">
    <!-- About Card -->
    <div class="w3-card w3-margin w3-margin-top">
        <img src="{{ asset('assets/frontend/images/nuestros-pastores-2.jpg') }}" style="width:100%">
        <div class="w3-container w3-white">
            <h4 class=""><b>Nuestro Pastores</b></h4>
            <p>Just me, myself and I, exploring the universe of uknownment. I have a heart of love and a interest of lorem ipsum and mauris neque quam blog. I want to share my world with you.</p>
        </div>
    </div><hr>

    <!-- Posts -->
    <div class="w3-card w3-margin">
        <div class="w3-container w3-padding w3-deep-orange">
            <h4>Los Post Más Populares</h4>
        </div>
        <ul class="w3-ul w3-hoverable w3-white">
            @foreach($categories as $category)
            <li class="w3-padding-16">
                <img src="{{ Storage::disk('public')->url('category/'.$category->image) }}"  alt="Image" class="w3-left w3-margin-right" style="width:50px">
                <span class="w3-large">{{ $category->name }}</span><br>
            </li>
            @endforeach

        </ul>
    </div>
    <hr>

    <!-- Labels / tags -->
    <div class="w3-card w3-margin">
        <div class="w3-container w3-padding w3-deep-orange">
            <h4>Etiquetas</h4>
        </div>
        <div class="w3-container w3-white">
            <p>
                @foreach($tags as $tag)
                <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">{{ $tag->name }}</span>
                @endforeach
        </div>
    </div>

    <!-- END Introduction Menu -->
</div>
