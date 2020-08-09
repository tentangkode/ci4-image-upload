<?php namespace App\Controllers;

class ImageUpload extends BaseController
{
	public function index()
	{
		if ($this->request->getMethod() === 'post') {

			$rules = [
				'image' => [
					'label' => 'Avatar',
					'rules' => 'uploaded[image]|is_image[image]|max_size[image,1024]'
				],
				'keterangan' => [
					'label' => 'Keterangan Gambar',
					'rules' => 'required'
				]
			];

			if ($this->validate($rules)) {

				$image = $this->request->getFile('image');
				$image->move('uploads');
			
				return redirect()->back()->with('success', 'Data berhasil disimpan');
			}

			return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());

		}

		return view('upload');
	}

}
