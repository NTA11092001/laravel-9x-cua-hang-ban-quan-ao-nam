@extends('WEB.master')
@section('content')
    <div class="row">
        <h1>LIÊN HỆ</h1>
        <section class="lienhe">
            <div class="container">
                <div class="containerinfo">
                    <h2>Thông Tin Liên Hệ</h2>
                    <ul class="info">
                        <li>
                            <span><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                            <span>Trường Đại học Điện Lực, 235 Hoàng Quốc Việt, Cổ Nhuế, Bắc Từ Liêm, Hà Nội, Việt Nam</span>
                        </li>
                        <li>
                            <span><i class="fa fa-envelope" aria-hidden="true"></i></span>
                            <span>info@epu.edu.vn</span>
                        </li>
                        <li>
                            <span><i class="fa fa-phone-square" aria-hidden="true"></i></span>
                            <span>024.8362672</span>
                        </li>
                    </ul>
                </div>
                <!-- Bắt đầu đoạn mã mới-->
                <div class="containerForm">
                    <h2>Gửi Lời Nhắn</h2>
                    <div class="formBox">
                        <div class="inputBox w50">
                            <input type="text" name="" required>
                            <span>Họ</span>
                        </div>
                        <div class="inputBox w50">
                            <input type="text" name="" required>
                            <span>Tên</span>
                        </div>
                        <div class="inputBox w50">
                            <input type="text" name="" required>
                            <span>Email</span>
                        </div>
                        <div class="inputBox w50">
                            <input type="text" name="" required>
                            <span>Số Điện Thoại</span>
                        </div>
                        <div class="inputBox w100">
                            <textarea name="" required></textarea>
                            <span>Lời Nhắn Của Bạn</span>
                        </div>
                        <div class="inputBox w100">
                            <input type="submit" value="Gửi">
                        </div>
                    </div>
                </div>
                <!-- Kết thúc đoạn mã mới-->
            </div>
        </section>
    </div>
    <div class="container-fuild d-flex justify-content-center">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.6571856852916!2d105.78272751476362!3d21.046398585988825!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135abb158a2305d%3A0x5c357d21c785ea3d!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyDEkGnhu4duIEzhu7Fj!5e0!3m2!1svi!2s!4v1638678515224!5m2!1svi!2s" width="80%" height="450" style="border:0;margin-left:50px" allowfullscreen="" loading="lazy"></iframe>
    </div>

@endsection
