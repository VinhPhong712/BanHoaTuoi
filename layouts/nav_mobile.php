<input type="checkbox"  name="" class="nav__input" id="nav-mobile-input" hidden>
<label for= "nav-mobile-input" class="nav__overlay"></label>
<div class="wide-nav">
        <label for= "nav-mobile-input" class="close__overlay">
            <i class="fas fa-times"></i>
        </label>
    <div class="wide-nav-box">
        <ul class="wide-nav-ul">
            <li class="nav-item-mobile tag-li ">
                <a href="<?=$baseUrl?>" class="tag-a">
                    <span class="danhmuc-trangchu">Trang chủ</span>
                </a>
            </li>
            <li class="nav-item-mobile tag-li ">
                <a href="<?=$baseUrl?>gioithieu" class="tag-a">
                    <span class="danhmuc-gioithieu">Giới thiệu</span>
                </a>
            </li>
            <li class="nav-item-mobile tag-li ">
                <a href="<?=$baseUrl?>allproduct" class="tag-a">
                    <span class="danhmuc-sanpham">Tất cả sản phẩm<i class="fa-solid fa-caret-down"></i></span>
                </a>
            </li>
            <li class="nav-item-mobile tag-li ">
                <a href="<?=$baseUrl?>blog" class="tag-a">
                    <span class="danhmuc-blog">Blog</span>
                </a>
            </li>
            <li class="nav-item-mobile tag-li ">
                <a href="<?=$baseUrl?>lienhe" class="tag-a">
                    <span class="danhmuc-lienhe">Liên hệ</span>
                </a>
            </li>
        </ul>
    </div>
</div>