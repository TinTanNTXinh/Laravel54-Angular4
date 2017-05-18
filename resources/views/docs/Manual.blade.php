<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manual</title>
    <link rel="stylesheet" href="{{ URL::to('libs/stackedit/base.css') }}" />
    <script type="text/javascript" src="{{ URL::to('libs/stackedit/MathJax.js') }}"></script>
</head>
<body><div class="container"><h1 id="tài-liệu-mô-tả-định-dạng-dữ-liệu-v320">TÀI LIỆU MÔ TẢ ĐỊNH DẠNG DỮ LIỆU (v3.2.0)</h1>

    <p>Ứng dụng web quản lý <strong><em>tủ ký gửi, máy bán nước, kho </em></strong> tự động</p>

    <hr>

    <h2 id="xóa-tất-cả-dữ-liệu">Xóa tất cả dữ liệu</h2>

    <p>Gõ địa chỉ bên dưới trên trình duyệt và đợi thông báo tác vụ thành công. <br>
        <a href="http://showroom.app-demo.info/artisan/reset">http://showroom.app-demo.info/artisan/reset</a></p>



    <h2 id="nạp-tiền">Nạp tiền </h2>

    <p>Server: <a href="http://showroom.app-demo.info/api/v1/cdm">http://showroom.app-demo.info/api/v1/cdm</a></p>

    <blockquote>
        <p><strong>Cấu trúc dữ liệu gửi lên server:</strong></p>

        <ul>
            <li>c1: Ngày xảy ra hành động (dd/mm/yy hh:ii:ss)</li>
            <li>c2: Mã thẻ</li>
            <li>c3: Mã máy nạp tiền</li>
            <li>c4: Trạng thái (“DPS”)</li>
            <li>c5: Số tiền của thẻ</li>
            <li>c6: Số tiền nạp</li>
        </ul>
    </blockquote>

    <p>Ví dụ minh họa:</p>

    <pre class="prettyprint"><code class=" hljs avrasm"><span class="hljs-label">http:</span>//showroom<span class="hljs-preprocessor">.app</span>-demo<span class="hljs-preprocessor">.info</span>/api/v1/cdm?param={<span class="hljs-string">"u"</span>:<span class="hljs-string">""</span>,<span class="hljs-string">"p"</span>:<span class="hljs-string">""</span>,<span class="hljs-string">"id"</span>:<span class="hljs-string">"IO53A096"</span>,<span class="hljs-string">"cnt"</span>:<span class="hljs-string">"1"</span>,<span class="hljs-string">"t"</span>:<span class="hljs-string">"2017-01-20 10:16:38"</span>,<span class="hljs-string">"c1"</span>:<span class="hljs-string">"15/03/17 10:16:38"</span>,<span class="hljs-string">"c2"</span>:<span class="hljs-string">"75EC5428E5"</span>,<span class="hljs-string">"c3"</span>:<span class="hljs-string">"CDM1"</span>,<span class="hljs-string">"c4"</span>:<span class="hljs-string">"DPS"</span>,<span class="hljs-string">"c5"</span>:<span class="hljs-string">"500000"</span>,<span class="hljs-string">"c6"</span>:<span class="hljs-string">"500000"</span>}</code></pre>



    <h2 id="nạp-hàng">Nạp hàng</h2>

    <p>Server: <a href="http://showroom.app-demo.info/api/v1/prod-inout">http://showroom.app-demo.info/api/v1/prod-inout</a></p>

    <blockquote>
        <p><strong>Cấu trúc dữ liệu gửi lên server:</strong></p>

        <ul>
            <li>c1: Ngày xảy ra hành động (dd/mm/yy hh:ii:ss)</li>
            <li>c2: Mã thẻ</li>
            <li>c3: Mã box</li>
            <li>c4: Trạng thái (“IN”)</li>
            <li>c5: Số tiền của thẻ</li>
            <li>c6: Số lượng nạp</li>
            <li>c7: Giá sản phẩm</li>
            <li>c8: Mã tủ</li>
        </ul>
    </blockquote>

    <p>Ví dụ minh họa:</p>

    <pre class="prettyprint"><code class=" hljs avrasm"><span class="hljs-label">http:</span>//showroom<span class="hljs-preprocessor">.app</span>-demo<span class="hljs-preprocessor">.info</span>/api/v1/prod-inout?param={<span class="hljs-string">"u"</span>:<span class="hljs-string">""</span>,<span class="hljs-string">"p"</span>:<span class="hljs-string">""</span>,<span class="hljs-string">"id"</span>:<span class="hljs-string">"IO53A096"</span>,<span class="hljs-string">"cnt"</span>:<span class="hljs-string">"2"</span>,<span class="hljs-string">"t"</span>:<span class="hljs-string">"2017-01-20 10:16:38"</span>,<span class="hljs-string">"c1"</span>:<span class="hljs-string">"15/03/17 10:16:38"</span>,<span class="hljs-string">"c2"</span>:<span class="hljs-string">"252858287D"</span>,<span class="hljs-string">"c3"</span>:<span class="hljs-string">"1"</span>,<span class="hljs-string">"c4"</span>:<span class="hljs-string">"IN"</span>,<span class="hljs-string">"c5"</span>:<span class="hljs-string">"510000"</span>,<span class="hljs-string">"c6"</span>:<span class="hljs-string">"1"</span>,<span class="hljs-string">"c7"</span>:<span class="hljs-string">"10000"</span>,<span class="hljs-string">"c8"</span>:<span class="hljs-string">"TU1"</span>}</code></pre>



    <h2 id="bán-hàng">Bán hàng</h2>

    <p>Server: <a href="http://showroom.app-demo.info/api/v1/prod-inout">http://showroom.app-demo.info/api/v1/prod-inout</a></p>

    <blockquote>
        <p><strong>Cấu trúc dữ liệu gửi lên server:</strong></p>

        <ul>
            <li>c1: Ngày xảy ra hành động (dd/mm/yy hh:ii:ss)</li>
            <li>c2: Mã thẻ</li>
            <li>c3: Mã box</li>
            <li>c4: Trạng thái (“OUT”)</li>
            <li>c5: Số tiền của thẻ</li>
            <li>c6: Số lượng bán</li>
            <li>c7: Giá sản phẩm</li>
            <li>c8: Mã tủ</li>
        </ul>
    </blockquote>

    <p>Ví dụ minh họa:</p>

    <pre class="prettyprint"><code class=" hljs avrasm"><span class="hljs-label">http:</span>//showroom<span class="hljs-preprocessor">.app</span>-demo<span class="hljs-preprocessor">.info</span>/api/v1/prod-inout?param={<span class="hljs-string">"u"</span>:<span class="hljs-string">"demo"</span>,<span class="hljs-string">"p"</span>:<span class="hljs-string">""</span>,<span class="hljs-string">"id"</span>:<span class="hljs-string">"IO53A096"</span>,<span class="hljs-string">"cnt"</span>:<span class="hljs-string">"3"</span>,<span class="hljs-string">"t"</span>:<span class="hljs-string">"2017-01-20 10:16:38"</span>,<span class="hljs-string">"c1"</span>:<span class="hljs-string">"20/01/17 10:16:38"</span>,<span class="hljs-string">"c2"</span>:<span class="hljs-string">"75EC5428E5"</span>,<span class="hljs-string">"c3"</span>:<span class="hljs-string">"1"</span>,<span class="hljs-string">"c4"</span>:<span class="hljs-string">"OUT"</span>,<span class="hljs-string">"c5"</span>:<span class="hljs-string">"490000"</span>,<span class="hljs-string">"c6"</span>:<span class="hljs-string">"1"</span>,<span class="hljs-string">"c7"</span>:<span class="hljs-string">"10000"</span>,<span class="hljs-string">"c8"</span>:<span class="hljs-string">"TU1"</span>}</code></pre>



    <h2 id="đăng-ký-thẻ-cho-khách-vãng-lai">Đăng ký thẻ cho khách vãng lai</h2>

    <p>Server: <a href="http://showroom.app-demo.info/api/v1/reg-visitor">http://showroom.app-demo.info/api/v1/reg-visitor</a></p>

    <blockquote>
        <p><strong>Cấu trúc dữ liệu gửi lên server:</strong></p>

        <ul>
            <li>c1: Ngày xảy ra hành động (dd/mm/yy hh:ii:ss)</li>
            <li>c2: Mã thẻ</li>
            <li>c3: Mã thiết bị đăng ký thẻ</li>
            <li>c4: “”</li>
            <li>c5: Số tiền của thẻ</li>
            <li>c6: Số điện thoại của Khách vãng lai</li>
        </ul>
    </blockquote>

    <p>Ví dụ minh họa:</p>

    <pre class="prettyprint"><code class=" hljs avrasm"><span class="hljs-label">http:</span>//showroom<span class="hljs-preprocessor">.app</span>-demo<span class="hljs-preprocessor">.info</span>/api/v1/reg-visitor?param={<span class="hljs-string">"u"</span>:<span class="hljs-string">"demo"</span>,<span class="hljs-string">"p"</span>:<span class="hljs-string">""</span>,<span class="hljs-string">"id"</span>:<span class="hljs-string">"IO53A096"</span>,<span class="hljs-string">"cnt"</span>:<span class="hljs-string">"3"</span>,<span class="hljs-string">"t"</span>:<span class="hljs-string">"2017-01-20 10:16:38"</span>,<span class="hljs-string">"c1"</span>:<span class="hljs-string">"20/01/17 10:16:38"</span>,<span class="hljs-string">"c2"</span>:<span class="hljs-string">"75EC5428E5"</span>,<span class="hljs-string">"c3"</span>:<span class="hljs-string">"CDM1"</span>,<span class="hljs-string">"c4"</span>:<span class="hljs-string">""</span>,<span class="hljs-string">"c5"</span>:<span class="hljs-string">"0"</span>,<span class="hljs-string">"c6"</span>:<span class="hljs-string">"0987654321"</span>}</code></pre>



    <h2 id="kiểm-tra-số-lượng-hàng-tồn-trên-box">Kiểm tra số lượng hàng tồn trên box</h2>

    <p>Server sẽ trả về số lượng hàng trên box mà ta gửi. </p>

    <p>Server: <a href="http://showroom.app-demo.info/api/v1/check-stock">http://showroom.app-demo.info/api/v1/check-stock</a></p>

    <blockquote>
        <p><strong>Cấu trúc dữ liệu gửi lên server:</strong></p>

        <ul>
            <li>c1: Ngày xảy ra hành động (dd/mm/yy hh:ii:ss)</li>
            <li>c2: Mã tủ</li>
            <li>c3: Mã box</li>
        </ul>
    </blockquote>

    <p>Ví dụ minh họa:</p>

    <pre class="prettyprint"><code class=" hljs avrasm"><span class="hljs-label">http:</span>//showroom<span class="hljs-preprocessor">.app</span>-demo<span class="hljs-preprocessor">.info</span>/api/v1/check-stock?param={<span class="hljs-string">"u"</span>:<span class="hljs-string">"demo"</span>,<span class="hljs-string">"p"</span>:<span class="hljs-string">""</span>,<span class="hljs-string">"id"</span>:<span class="hljs-string">"IO53A096"</span>,<span class="hljs-string">"cnt"</span>:<span class="hljs-string">"3"</span>,<span class="hljs-string">"t"</span>:<span class="hljs-string">"2017-01-20 10:16:38"</span>,<span class="hljs-string">"c1"</span>:<span class="hljs-string">"20/01/17 10:16:38"</span>,<span class="hljs-string">"c2"</span>:<span class="hljs-string">"TU1"</span>,<span class="hljs-string">"c3"</span>:<span class="hljs-string">"1"</span>}</code></pre>



    <h2 id="debug">Debug</h2>

    <blockquote>
        <p><strong>Tip:</strong> Khi muốn xem dữ liệu gửi lên server đã đúng hay chưa thì thêm trường <code>{"debug":"1"}</code> vào trong chuỗi json. Khi đó server sẽ trả về chuỗi json mà ta gửi đến trong request.</p>
    </blockquote>

    <p>Ví dụ debug chức năng nạp hàng:</p>



    <pre class="prettyprint"><code class=" hljs avrasm"><span class="hljs-label">http:</span>//showroom<span class="hljs-preprocessor">.app</span>-demo<span class="hljs-preprocessor">.info</span>/api/v1/prod-inout?param={<span class="hljs-string">"u"</span>:<span class="hljs-string">""</span>,<span class="hljs-string">"p"</span>:<span class="hljs-string">""</span>,<span class="hljs-string">"id"</span>:<span class="hljs-string">"IO53A096"</span>,<span class="hljs-string">"cnt"</span>:<span class="hljs-string">"2"</span>,<span class="hljs-string">"t"</span>:<span class="hljs-string">"2017-01-20 10:16:38"</span>,<span class="hljs-string">"c1"</span>:<span class="hljs-string">"15/03/17 10:16:38"</span>,<span class="hljs-string">"c2"</span>:<span class="hljs-string">"252858287D"</span>,<span class="hljs-string">"c3"</span>:<span class="hljs-string">"1"</span>,<span class="hljs-string">"c4"</span>:<span class="hljs-string">"IN"</span>,<span class="hljs-string">"c5"</span>:<span class="hljs-string">"510000"</span>,<span class="hljs-string">"c6"</span>:<span class="hljs-string">"1"</span>,<span class="hljs-string">"c7"</span>:<span class="hljs-string">"10000"</span>,<span class="hljs-string">"c8"</span>:<span class="hljs-string">"TU1"</span>,<span class="hljs-string">"debug"</span>:<span class="hljs-string">"1"</span>}</code></pre>



    <h2 id="contact">Contact</h2>

    <p>Contact with us via <a>Skype</a>, <a href="mailto:ntxinh@tintansoft.com">Gmail</a>.</p></div></body>
</html>