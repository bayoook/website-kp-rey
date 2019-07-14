</div>
<footer class="bg-white sticky-footer" style="margin-top:100px">
    <div class="container my-auto">
        <div class="text-center my-auto copyright"><span>Copyright © <a href="<?= $_SESSION['IMPORTANT_H'] ?>"><?= $_SESSION['IMPORTANT_P'] ?></a>
                <?= $_SESSION['IMPORTANT_Y'] ?></span></div>
    </div>
</footer>
</div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
</div>
<script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/js/chart.min.js"></script>
<script src="<?= base_url() ?>assets/js/bs-charts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
<script type="text/javascript" charset="utf8" src="<?= base_url() ?>assets/vendor/datatables/jquery.dataTables.min.js">
</script>
<script type="text/javascript" charset="utf8" src="<?= base_url() ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.29.2/sweetalert2.all.js"></script>
<script src="<?= base_url() ?>assets/js/script.js"></script>
<script src="<?= base_url() ?>assets/js/theme.js"></script>
<script src="<?= base_url() ?>assets/js/demo/datatables-demo.js"></script>
<script type="text/javascript">

</script>
</body>

</html>
<script>
    var table = document.getElementById('table');
    var butShow = document.getElementById('tampil');
    var butSpan = document.getElementById('butSpan');
    tampil.onclick = displayTable;

    function displayTable() {
        if (table.style.display != "none") {
            table.style.display = "none";
            butSpan.innerHTML = "Show Table"
        } else {
            table.style.display = "";
            butSpan.innerHTML = "Hide Table";
        }
    }
</script>