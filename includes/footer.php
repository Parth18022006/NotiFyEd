<style>
    .site-footer {
        background-color: #6a00ff;
        color: #fff;
        font-size: 0.9rem;
        border-top: 2px solid rgba(255, 255, 255, 0.15);
        width: 100%;
    }

    /* Remove Bootstrap container max-width for footer */
    .site-footer .container {
        max-width: 100% !important;
        padding-left: 1rem;
        padding-right: 1rem;
    }

    .footer-text {
        color: #f4f0fa;
        font-weight: 500;
    }

    .footer-author {
        position: relative;
        color: #ffd54f;
        font-weight: 700;
    }

    .footer-author::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: -2px;
        width: 0;
        height: 2px;
        background-color: #ff66c4;
        transition: width 0.3s ease;
    }

    .footer-author:hover::after {
        width: 100%;
    }

    .site-footer a {
        text-decoration: none;
        color: inherit;
    }

    .site-footer a:hover {
        text-decoration: underline;
    }

    /* Mobile responsiveness fix */
    @media (max-width: 768px) {
        .site-footer .row {
            text-align: center;
        }
        .site-footer .col-md-6 {
            margin-bottom: 0.5rem;
        }
    }
</style>
<!-- Footer Start -->
<div class="container-fluid site-footer py-4">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-md-6 text-center text-md-start mb-md-0">
                <span class="footer-text">
                    <i class="fas fa-copyright me-2"></i>
                    NotiFyEd, All rights reserved.
                </span>
            </div>
            <div class="col-md-6 text-center text-md-end footer-text">
                Made by <span class="footer-author">PARTH CHAVDA</span>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->