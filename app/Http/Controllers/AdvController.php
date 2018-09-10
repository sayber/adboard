<?php

namespace App\Http\Controllers;

use App\Ads as Adv;
use App\Model\AdsImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class AdvController
 * @package App\Http\Controllers
 */
class AdvController extends Controller
{
    /** @var int */
    protected const COUNT = 20;

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $adsList = Adv::with(['users', 'image'])
            ->orderBy('created_at', 'desc')
            ->paginate(self::COUNT);
        return view('board.main', compact('adsList'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('board.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {

        $this->validate($request, ['title' => 'required', 'body' => 'required']);
        $adv = Adv::create([
            'title'   => $request->get('title'),
            'body'    => $request->get('body'),
            'user_id' => Auth::user()->id,
        ]);

        if ($request->hasFile('image') && !$this->storeImage($request->file('image'), $adv->id)) {
            throw new \LogicException('fail upload file');
        }



        return redirect('/')
            ->with('flash_notification.message', 'New ad created successfully')
            ->with('flash_notification.level', 'success');

    }

    /**
     * @param UploadedFile $file
     * @return bool
     */
    protected function storeImage(UploadedFile $file, $advId): bool
    {

        $fileData = [

            'name' => $file->getClientOriginalName(),
            'type' => $file->getType(),
            'extension' => $file->getClientOriginalExtension(),
            'ads_id'=> $advId
        ];

        AdsImages::create($fileData);
        //перемещаем загруженный файл
        $destinationPath = 'uploads';
        $file->move($destinationPath,$file->getClientOriginalName());

        return true;
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id): \Illuminate\Http\RedirectResponse
    {
        $board           = Adv::findOrFail($id);
        $board->bookmark = !$board->bookmark;
        $board->save();

        return redirect()
            ->route('board.index')
            ->with('flash_notification.message', 'Adv updated successfully')
            ->with('flash_notification.level', 'success');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function delete($id): \Illuminate\Http\RedirectResponse
    {

        $board = Adv::findOrFail($id);

        $board->delete();

        return redirect()
            ->route('board.index')
            ->with('flash_notification.message', 'Adv deleted successfully')
            ->with('flash_notification.level', 'success');
    }


}
