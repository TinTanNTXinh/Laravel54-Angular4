<?php

namespace App\Http\Controllers;

use App\Transport;
use Illuminate\Http\Request;

use App\Repositories\TransportRepositoryInterface;

class TestController extends Controller
{
    protected $postRepository  = '';
    public function __construct(TransportRepositoryInterface $PostRepositoryInterface)
    {
        $this->postRepository = $PostRepositoryInterface;
    }

    /**
     * Lấy danh sách post
     */
    function all()
    {
        $list = $this->postRepository->destroy(3);
        return $list;
    }
}
