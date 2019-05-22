<section class="index-contact">
    <div class="layer">
        <div class="container">
            <h3 data-aos="zoom-in" data-aos-duration="1000">Ada Pesan dan Komentar dan Pertanyaan?</h3>
            <p data-aos="zoom-in" data-aos-duration="1000"> Silahkan tinggalkan pesan anda disini</p>
            <form data-aos="fade-up" data-aos-duration="1000" action="{{route('comment')}}" method="post">
                <ul class="row">
                    <li class="col-md-4">
                        <input type="text" required class="w-100" placeholder="Nama" name="name">
                    </li>
                    <li class="col-md-4">
                        <input type="email" required class="w-100" placeholder="Email" name="email">
                    </li>
                    <li class="col-md-4">
                        <input type="text" required class="w-100" placeholder="No Hp" name="mobile">
                    </li>
                    <li class="col-12">
                        <textarea class="w-100" required placeholder="Pesan anda (max: 1000 character)" name="message" maxlength="1000"></textarea>
                    </li>
                </ul>
                <button type="submit">Kirim</button>
                {{ csrf_field() }}
            </form>
        </div>
    </div>
</section>
