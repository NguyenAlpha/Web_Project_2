<style>
    .payment-container {
        max-width: 800px;
        margin: 30px auto;
        padding: 20px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .qr-payment-box {
        display: flex;
        gap: 30px;
        margin: 30px 0;
    }

    .qr-code {
        text-align: center;
        padding: 15px;
        border: 1px solid #eee;
        border-radius: 5px;
    }

    .qr-code img {
        width: 200px;
        height: 200px;
    }

    .bank-info {
        flex: 1;
        padding: 15px;
        background: #f9f9f9;
        border-radius: 5px;
    }

    .btn-confirm {
        background: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn-cancel {
        background: #f44336;
        color: white;
        padding: 10px 20px;
        border-radius: 4px;
        text-decoration: none;
        margin-left: 10px;
    }
</style>
<main class="container">
    <div class="payment-container">
        <h1>Thanh toán đơn hàng #<?= $order['MaDon'] ?></h1>
        
        <div class="qr-payment-box">
            <div class="qr-code">
                <img src="assets/image/z6592441556638_844402ac32ad3a70af21f07c62751376.jpg" alt="Mã QR Thanh Toán">
                <p>Quét mã để thanh toán</p>
            </div>
            
            <div class="bank-info">
                <h3>Thông tin chuyển khoản</h3>
                <p><strong>Ngân hàng:</strong> <?= $bankInfo['name'] ?></p>
                <p><strong>Số tài khoản:</strong> <?= $bankInfo['account'] ?></p>
                <p><strong>Chủ tài khoản:</strong> <?= $bankInfo['holder'] ?></p>
                <p><strong>Số tiền:</strong> <?= number_format($bankInfo['amount'], 0, ',', '.') ?>đ</p>
                <p><strong>Nội dung:</strong> <?= $bankInfo['content'] ?></p>
            </div>
        </div>
        
        <form action="?controller=payment&action=verifyPayment" method="post">
            <input type="hidden" name="order_id" value="<?= $order['MaDon'] ?>">
            <button type="submit" class="btn-confirm">Tôi đã thanh toán</button>
            <a href="?controller=cart" class="btn-cancel">Hủy đơn hàng</a>
        </form>
    </div>
</main>