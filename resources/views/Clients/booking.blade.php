@include('Clients.blocks.header')
@include('Clients.blocks.banner', ['title' => 'Đặt Tour'])
@if(session('error'))
<div class="alert alert-danger">
{{ session('error') }}
</div> 
@endif
@if(session('success'))
    <div class="booking-notification" style="
        position: fixed;
        top: 100px;
        right: 20px;
        z-index: 9999;
        min-width: 300px;
        background: #28a745;
        color: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        display: flex;
        align-items: center;
        justify-content: space-between;
        animation: slideInRight 0.5s ease-out;
    ">
        <div>
            <i class="fas fa-check-circle" style="margin-right: 10px; font-size: 1.2rem;"></i>
            <strong>Thành công!</strong> {{ session('success') }}
        </div>
        <button type="button" onclick="this.parentElement.remove()" style="
            background: none;
            border: none;
            color: white;
            font-size: 20px;
            cursor: pointer;
            line-height: 1;
            margin-left: 15px;
        ">&times;</button>
    </div>

    <style>
        @keyframes slideInRight {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
    </style>

    <script>
        // Tự động đóng sau 5 giây
        setTimeout(function() {
            const notify = document.querySelector('.booking-notification');
            if(notify) notify.style.display = 'none';
        }, 5000);
    </script>
@endif  
    <section class="container" style="margin-top: 50px;">
<form action="{{ route('booking.store', ['id' => $tour->tourid]) }}" method="post" class ="booking-container">
    @csrf
            <!-- Contact Information -->
            <div class="booking-info">
                <h2 class="booking-header">Thông Tin Liên Lạc</h2>
                <div class="booking__infor">
                    <div class="form-group">
                        <label for="username">Họ và tên*</label>
                        <input type="text"
                            id="username"
                            name="username"
                            value="{{ session('username') ?? '' }}"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email*</label>
                        <input type="email"
                        name="email"
                        value="{{ session('email') ?? '' }}"
                        required>
                    </div>

                    <div class="form-group">
                        <label for="tel">Số điện thoại*</label>
                        <input type="tel" id="tel" name="tel" placeholder="Nhập số điện thoại liên hệ" value="{{ session('phoneNumber') ?? session('tel') ?? '' }}" required>
                    </div>

                    <div class="form-group">
                        <label for="address">Địa chỉ*</label>
<input type="text" id="address" name="dia_chi" placeholder="Nhập địa chỉ của bạn" value="{{ session('address') ?? session('dia_chi') ?? '' }}" required>
                    </div>
                </div>


                <!-- Passenger Details -->
                <h2 class="booking-header">Hành Khách</h2>

                <div class="booking__quantity">
                    <div class="form-group quantity-selector">
                        <label>Người lớn</label>
                        <div class="input__quanlity">
                            <button type="button" class="quantity-btn">-</button>
                            <input type="number" name="numadults" id="numadults" value="1" readonly>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                    </div>

                    <div class="form-group quantity-selector">
                        <label>Trẻ em</label>
                        <div class="input__quanlity">
                            <button type="button" class="quantity-btn">-</button>
                            <input type="number" name="numchildren" id="numchildren" value="0" readonly>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                    </div>
                </div>
                <!-- Privacy Agreement Section -->
                <div class="privacy-section">
                    <p>Bằng cách nhấp chuột vào nút "ĐỒNG Ý" dưới đây, Khách hàng đồng ý rằng các điều kiện điều khoản
                        này sẽ được áp dụng. Vui lòng đọc kỹ điều kiện điều khoản trước khi lựa chọn sử dụng dịch vụ của
                        Lửa Việt Tours.</p>
                    <div class="privacy-checkbox">
                        <input type="checkbox" id="agree" name="agree" required>
                        <label for="agree">Tôi đã đọc và đồng ý với <a href="#" target="_blank">Điều khoản thanh
                                toán</a></label>
                    </div>
                </div>
                <!-- Payment Method -->
                <h2 class="booking-header">Phương Thức Thanh Toán</h2>

                <label class="payment-option d-block mb-3 p-3 border rounded">
                    <input type="radio" name="paymentmethod" value="paypal" required>
                    <img src="{{ asset('clients/assets/images/checkout/paypal.png') }}" alt="PayPal" style="height: 25px; margin: 0 10px;">
                    Thanh toán bằng PayPal
                </label>

<label class="payment-option d-block mb-3 p-3 border rounded">
    <input type="radio" name="paymentmethod" value="momo" required>
    <img src="https://upload.wikimedia.org/wikipedia/vi/f/fe/MoMo_Logo.png" alt="MoMo" style="height:25px;margin:0 10px;">
    Thanh toán cọc (30%) trực tuyến bằng Ví MoMo
</label>

<label class="payment-option d-block mb-3 p-3 border rounded">
    <input type="radio" name="paymentmethod" value="cash" required>
    <i class="fas fa-money-bill-wave text-success" style="font-size: 20px; margin: 0 10px;"></i>
    Tiền mặt / Chuyển khoản (Liên hệ tư vấn viên để cọc 30%)
</label>


            </div>

            <!-- Order Summary -->
            <div class="booking-summary">
                <div class="summary-section">
                    <div>
                        <p>Mã tour : {{ $tour->tourid }}</p>
                        <h4>{{ $tour->title }}</h4>
                        <p>Ngày khởi hành : {{ $tour->startdate }}</p>
                        <p>Ngày kết thúc : {{ $tour->enddate }}</p>
                    </div>

                    <div class="summary-item">
                        <span>Người lớn:</span>
                        <div>
                            <span class="quantity__adults">1</span>
                            <span>X</span>
                            <span id="priceAdultDisplay">0 VNĐ</span>
                        </div>
                    </div>

                    <div class="summary-item">
                        <span>Trẻ em:</span>
                        <div>
                            <span class="quantity__children">0</span>
                            <span>X</span>
                            <span id="priceChildDisplay">0 VNĐ</span>
                        </div>
                    </div>

                    <div class="summary-item" id="discountRow" style="display: none; color: #28a745; justify-content: space-between; border-top: 1px dashed #ccc; padding-top: 10px;">
                        <span><i class="fas fa-tags"></i> Giảm giá (<span id="discountPercentDisplay">0</span>%):</span>
                        <span id="discountAmountDisplay" style="font-weight: bold;">- 0 VNĐ</span>
                    </div>

                    <div class="summary-item total-price" style="align-items: flex-end;">
                        <span>Tổng cộng:</span>
                        <div style="text-align: right;">
                            <del id="mathFormula" style="font-size: 13px; color: #999; display: none;">0 - 0</del><br>
                            <span id="totalPrice" style="color: #e53935; font-size: 1.5rem; font-weight: bold;">0 VNĐ</span>
                        </div>
                    </div>

                    <div class="summary-item deposit-price">
                        <div>
                            <span style="color: #e53935; font-weight: bold;">Cần thanh toán cọc (30%):</span>
                            <span id="depositPrice" style="color: #e53935; font-weight: bold; font-size: 1.2rem;">0 VNĐ</span>
                        </div>
                    </div>

                    <div class="order-coupon">
                        <input type="text" id="coupon_input" placeholder="Nhập mã giảm giá" style="width: 65%">
                        <button type="button" id="apply_coupon" style="width: 30%;" class="booking-btn">Áp dụng</button>
                        
                        <div id="coupon_msg" class="mt-2 small"></div>
                        <input type="hidden" name="coupon_code_hidden" id="coupon_code_hidden">
                    </div>

                    <button type="submit" class="booking-btn mt-3">Xác Nhận và Thanh Toán</button>
                </div>
            </div>
        </form>
    </section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const rawPriceAdult = "{{ $tour->priceadult ?? 0 }}";
    const rawPriceChild = "{{ $tour->pricechild ?? 0 }}";
    let discountPercent = 0; // Khởi tạo mặc định giảm 0%

    function cleanPrice(priceString) {
        if (!priceString) return 0;
        let cleanString = priceString.toString().replace(/[^0-9]/g, "");
        let price = parseInt(cleanString);
        return isNaN(price) ? 0 : price;
    }

    const priceAdult = cleanPrice(rawPriceAdult);
    const priceChild = cleanPrice(rawPriceChild);

    function updatePrice() {
        let inputAdult = document.querySelector('input[name="numadults"]');
        let inputChild = document.querySelector('input[name="numchildren"]');

        let adults = inputAdult && inputAdult.value ? parseInt(inputAdult.value) : 1;
        let children = inputChild && inputChild.value ? parseInt(inputChild.value) : 0;

        if (isNaN(adults) || adults < 1) adults = 1;
        if (isNaN(children) || children < 0) children = 0;

        let totalAdult = adults * priceAdult;
        let totalChild = children * priceChild;
        let subTotal = totalAdult + totalChild; // Tiền gốc (Tạm tính)

        let discountAmount = subTotal * (discountPercent / 100);
        let grandTotal = subTotal - discountAmount; // Tiền sau giảm
        let depositTotal = grandTotal * 0.3;

        // Cập nhật text số lượng
        document.querySelectorAll(".quantity__adults").forEach(el => el.innerText = adults);
        document.querySelectorAll(".quantity__children").forEach(el => el.innerText = children);

        // Cập nhật text giá
        document.querySelectorAll("#priceAdultDisplay").forEach(el => el.innerText = totalAdult.toLocaleString('vi-VN') + " VNĐ");
        document.querySelectorAll("#priceChildDisplay").forEach(el => el.innerText = totalChild.toLocaleString('vi-VN') + " VNĐ");
        
        // --- XỬ LÝ HIỂN THỊ PHÉP TÍNH ---
        let discountRow = document.getElementById('discountRow');
        let mathFormula = document.getElementById('mathFormula');

        if (discountPercent > 0) {
            // Hiện dòng chữ xanh "Giảm giá"
            discountRow.style.display = "flex";
            document.getElementById('discountPercentDisplay').innerText = discountPercent;
            document.getElementById('discountAmountDisplay').innerText = "- " + discountAmount.toLocaleString('vi-VN') + " VNĐ";
            
            // Hiện công thức tính gạch ngang: "Tiền gốc - Tiền giảm"
            mathFormula.style.display = "inline-block";
            mathFormula.innerText = subTotal.toLocaleString('vi-VN') + " VNĐ";
        } else {
            // Ẩn đi nếu không có mã
            discountRow.style.display = "none";
            mathFormula.style.display = "none";
        }

        // Cập nhật Tổng tiền cuối và cọc
        document.querySelectorAll("#totalPrice").forEach(el => el.innerText = grandTotal.toLocaleString('vi-VN') + " VNĐ");
        document.querySelectorAll("#depositPrice").forEach(el => el.innerText = depositTotal.toLocaleString('vi-VN') + " VNĐ");
    }

    document.querySelectorAll(".quantity-btn").forEach(btn => {
        btn.addEventListener("click", function () {
            let input = this.parentNode.querySelector("input");
            if (!input) return;

            let value = parseInt(input.value);
            if (isNaN(value)) value = 0;

            let isAdult = input.name === "numadults";
            let min = isAdult ? 1 : 0; 

            if (this.textContent.trim() === "+") {
                value++;
            } else if (this.textContent.trim() === "-") {
                if (value > min) {
                    value--;
                }
            }
            input.value = value; 
            updatePrice(); 
        });
    });

    $('#apply_coupon').click(function() {
        let code = $('#coupon_input').val();
        if(!code) return alert("Vui lòng nhập mã");

        $.ajax({
            url: "{{ route('coupon.check') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                coupon_code: code
            },
            success: function(res) {
                if(res.success) {
                    $('#coupon_msg').html('<span class="text-success fw-bold">' + res.message + '</span>');
                    $('#coupon_code_hidden').val(code);
                    discountPercent = res.discount;
                    updatePrice();
                } else {
                    $('#coupon_msg').html('<span class="text-danger">' + res.message + '</span>');
                    $('#coupon_code_hidden').val('');
                    discountPercent = 0;
                    updatePrice();
                }
            }
        });
    });

    setTimeout(updatePrice, 200);
});
</script>

@include('Clients.blocks.footer')