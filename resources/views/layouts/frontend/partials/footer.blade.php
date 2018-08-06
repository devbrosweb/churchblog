<!-- Footer -->
<footer class="w3-container w3-dark-grey w3-padding-32 w3-margin-top">
    <div class="w3-row-padding">
        <div class="w3-col m4">Nombre de la empresa</div>
        <div class="w3-col m4">Mis redes sociales</div>
        <div class="w3-col m4">
            <div class="w3-container">
                <h2>Suscribete</h2>

                <div class="">
                    <form method="POST" action="{{ route('subscribers.store') }}"  class="w3-container">
                        @csrf
                        <p>
                            <div class="w3-row">
                                <div class="w3-col m9">
                                 <input class="w3-input " type="email" name="email" placeholder="suscribete@hazloahora.ya">
                                </div>
                                <div class="w3-col m2">
                                    <button type="submit" class="w3-btn w3-deep-orange">Suscribeme</button>
                                </div>
                            </div>

                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</footer>
</footer>