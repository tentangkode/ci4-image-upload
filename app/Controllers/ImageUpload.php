<?php namespace App\Controllers;

class ImageUpload extends BaseController
{
	public function index()
	{
		$db = \Config\Database::connect();

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
				$fileName = time().$image->getClientName();
				$image->move('uploads', $fileName);

				$db->table('gallery')->insert([
					'keterangan' => $this->request->getPost('keterangan'),
					'nama_file' => $fileName
				]);
			
				return redirect()->back()->with('success', 'Data berhasil disimpan');
			}

			return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());

		}

		$data['images'] = $db->table('gallery')->get()->getResult();

		return view('upload', $data);
	}

}
