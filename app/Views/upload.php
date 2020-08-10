<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Codeigniter File Upload</title>
</head>

<body>
    <div class="container">
        <br><br>
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <h5 class="card-header">File Upload</h5>
                    <div class="card-body">
                        <?php if(session()->has('success')): ?>
                            <p class="text-success"><?= session()->getFlashdata('success') ?></p>
                        <?php endif; ?>

                        <?php if(session()->has('error')): ?>
                            <p class="text-danger"><?= session()->getFlashdata('error') ?></p>
                        <?php endif; ?>
                        
                        <?php $validation = session()->getFlashdata('validation'); ?>

                        <form action="<?= current_url() ?>" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="">Keterangan Gambar</label>
                                <input type="text" value="<?= old('keterangan') ?>" name="keterangan" id="keterangan" class="form-control <?= $validation && isset($validation['keterangan']) ? 'is-invalid' : '' ?>">
                                <?php if ($validation && isset($validation['keterangan'])): ?>
                                    <div class="invalid-feedback"><?= $validation['keterangan'] ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="">Pilih File Gambar</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input <?= $validation && isset($validation['image']) ? 'is-invalid' : '' ?>" name="image" id="image">
                                    <label class="custom-file-label" for="file">Choose file</label>
                                    <?php if ($validation && isset($validation['image'])): ?>
                                        <div class="invalid-feedback"><?= $validation['image'] ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="img-preview" style="margin-bottom: 20px"></div>
                            <button class="btn btn-success">SIMPAN DATA</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-header">Data Gambar</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Keterangan</th>
                                    <th>Gambar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($images as $image): ?>
                                    <tr>
                                        <td><?= $image->gallery_id ?></td>
                                        <td><?= $image->keterangan ?></td>
                                        <td>
                                            <img style="height: 100px" src="<?= base_url('uploads/' . $image->nama_file) ?>"/>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script>
        function previewImg(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('.img-preview').html(`<img style="width: 100%" src="`+e.target.result+`"/>`);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#image").change(function() {
            previewImg(this);
        });
    </script>
</body>

</html>