<?php

namespace App\Http\Controllers;

use App\Common;
use App\User;
use App\Species;
use Illuminate\Http\Request;

use App\Scheme;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use UrlSigner;
use Carbon\Carbon;

class SpeciesController extends Controller
{
    /**
     * Display a listing of the species.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $speciesArr = DB::select("
		select id, species_name, miami_name, common_name
		from species
		inner join 
			(select oid, max(version) as mv
			from species
			where is_approved = 1
			group by oid) maxt
		on (species.oid = maxt.oid and species.version = maxt.mv)
		where is_approved = 1
		order by species_name IS NULL, species_name ASC
		");
        return view('species.index', ['speciesArr' => $speciesArr]);
    }

    /**
     * Show the page for creating a new species.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $schemeArr = Scheme::get();
        return view('species.create', ['schemeArr' => $schemeArr]);
    }

    /**
     * Store a newly created species in species table.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->all();
        unset($data['_token']);

        $data['user_id'] = Auth::user()->id;
        $data['oid'] = Common::makeObjectId();


        if (isset($data['photo']) && $request->file('photo')) {
            if (!in_array($request->file('photo')->getClientOriginalExtension(), ['jpeg', 'jpg', 'bmp', 'gif', 'png'])) {
                echo "not image";
                exit();
            }

            $path = $request->file('photo')->storePubliclyAs('photo', Common::makeObjectId() . '.' . $request->file('photo')->getClientOriginalExtension());
            $data['photo'] = $path;
        } else {
            unset($data['photo']);
        }

        if (isset($data['audio']) && $request->file('audio')) {
            if (!in_array($request->file('audio')->getClientOriginalExtension(), ["3gp", "aa", "aac", "aax", "act", "aiff", "amr", "ape", "au", "awb", "dct", "dss", "dvf", "flac", "gsm", "iklax", "ivs", "m4a", "m4b", "m4p", "mmf", "mp3", "mpc", "msv", "opus", "ra", "rm", "raw", "sln", "tta", "vox", "wav", "wma", "wv", "webm"])) {
                echo "not audio";
                exit();
            }

            $path = $request->file('audio')->storePubliclyAs('audio', Common::makeObjectId() . '.' . $request->file('audio')->getClientOriginalExtension());
            $data['audio'] = $path;
        } else {
            unset($data['audio']);
        }

        if(array_key_exists('reference_type', $data)){
        $sourceData = array();

        for($x = 0; $x < count($data['reference_type']); $x++){

            $sourceData = array(
                'oid' => $data['oid'],
                'reference_type' => $data['reference_type'][$x]['reference_type'],
                'content' => $data['content'][$x]['content'],
                'source' => $data['source'][$x]['source'],
                'source_date' => $data['source_date'][$x]['source_date'],
                'summary' => $data['summary'][$x]['summary'],
                'comments' => $data['comments'][$x]['comments'],
                'comment_user_id' => $data['user_id'],
                'source_type' => $data['source_type'][$x]['source_type'],
                'citation' => $data['citation'][$x]['citation']
            );

            DB::table('sources')->insert($sourceData);

        }
        //MAKE this a loop eventually
        unset($data['reference_type']);
        unset($data['content']);
        unset($data['source']);
        unset($data['source_date']);
        unset($data['summary']);
        unset($data['comments']);
        unset($data['source_type']);
        unset($data['citation']);
        }
            
        $newId = Species::createWithCurrentUser($data);
        return $this->show($newId);
    }

    /**
     * Display the specified species by id.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $schemeArr = Scheme::get();

        $species = Species::where('id', $id)->first();

        $speciesOid = $species->oid;
        //$speciesOid = mysql_real_escape_string($speciesOid);

        $sourceArr = DB::select("
		select *
		from sources
        left join users on sources.comment_user_id = users.id 
        WHERE sources.oid = '$speciesOid'
        ORDER BY sources.source_date DESC
        ");


        
        $photoUrl = '';
        $audioUrl = '';

        /*
        if($species->photo) {
            $photoUrl = UrlSigner::sign(url('file/'. $species->photo), Carbon::now()->addSeconds(10));
        }

        if($species->audio) {
            $audioUrl = UrlSigner::sign(url('file/'. $species->audio), Carbon::now()->addSeconds(300));
        }
        */
        
        return view('species.show', ['species' => $species, 'schemeArr' => $schemeArr, 'sourceArr' => $sourceArr, 'photoUrl' => $photoUrl, 'audioUrl' => $audioUrl]);
    }

    /**
     * Show the form for editing the specified species.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $schemeArr = Scheme::get();
        $species = Species::where('id', $id)->first();
        $speciesOid = $species->oid;
        
        $sourceArr = DB::select("
		SELECT *
		FROM sources
        WHERE sources.oid = '$speciesOid'
        ");

        $species = Species::where('is_approved', 1)->where('id', $id)->firstOrFail();

        return view('species.edit', ['species' => $species, 'schemeArr' => $schemeArr, 'sourceArr' => $sourceArr]);
    }

    /**
     * Update the specified species in species table.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        unset($data['_token']);
        if (isset($data['photo']) && $request->file('photo')) {
            if (!in_array($request->file('photo')->getClientOriginalExtension(), ['jpeg', 'jpg', 'bmp', 'gif', 'png'])) {
                echo "not image";
                exit();
            }

            $path = $request->file('photo')->storePubliclyAs('photo', Common::makeObjectId() . '.' . $request->file('photo')->getClientOriginalExtension());
            $data['photo'] = $path;
        } else {
            unset($data['photo']);
        }

        if (isset($data['audio']) && $request->file('audio')) {
            if (!in_array($request->file('audio')->getClientOriginalExtension(), ["3gp", "aa", "aac", "aax", "act", "aiff", "amr", "ape", "au", "awb", "dct", "dss", "dvf", "flac", "gsm", "iklax", "ivs", "m4a", "m4b", "m4p", "mmf", "mp3", "mpc", "msv", "opus", "ra", "rm", "raw", "sln", "tta", "vox", "wav", "wma", "wv", "webm"])) {
                echo "not audio";
                exit();
            }

            $path = $request->file('audio')->storePubliclyAs('audio', Common::makeObjectId() . '.' . $request->file('audio')->getClientOriginalExtension());
            $data['audio'] = $path;
        } else {
            unset($data['audio']);
        }
        
        $species = Species::where('id', $id)->first();
        $speciesOid = $species->oid;
        
        DB::table('sources')->where('oid', $speciesOid)->delete();
        
        if(array_key_exists('user_id', $data)){
            $user_id_count = count($data['user_id']);
        } else {
            $user_id_count = 0;
        }
        
        if(array_key_exists('reference_type', $data)){
        $sourceData = array();

        for($x = 0; $x < count($data['reference_type']); $x++){

            if($x < $user_id_count){
                $comment_user_id = $data['user_id'][$x]['user_id'];
            } else {
                $comment_user_id = Auth::user()->id;
            }
            $sourceData = array(
                'oid' => $speciesOid,
                'reference_type' => $data['reference_type'][$x]['reference_type'],
                'content' => $data['content'][$x]['content'],
                'source' => $data['source'][$x]['source'],
                'source_date' => $data['source_date'][$x]['source_date'],
                'summary' => $data['summary'][$x]['summary'],
                'comments' => $data['comments'][$x]['comments'],
                'comment_user_id' => $comment_user_id,
                'source_type' => $data['source_type'][$x]['source_type'],
                'citation' => $data['citation'][$x]['citation']
            );

            DB::table('sources')->insert($sourceData);

        }
        unset($data['reference_type']);
        unset($data['content']);
        unset($data['source']);
        unset($data['source_date']);
        unset($data['summary']);
        unset($data['comments']);
        unset($data['user_id']);
        unset($data['source_type']);
        unset($data['citation']);
        }


        $lastInsertedId = Species::updateWithCurrentUser($id, $data);

        return $this->show($lastInsertedId);
    }

    /**
     * Remove the specified species from species table.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $species = Species::findOrFail($id);
        Species::where(['oid' => $species->oid])->delete();
        DB::table('sources')->where('oid', $species->oid)->delete();
        
        
        return redirect(route('species.index'));
    }

    /**
     * Display a listing of history for specified species and attribute.
     *
     * @param  int $id
     * @param  string $key
     * @return \Illuminate\Http\Response
     */
    public function history($id, $key)
    {
        $nameArr = Scheme::select(['name'])->where('key', $key)->get()->toArray();
        $name = $nameArr[0]['name'];
        $oid = Species::find($id)->oid;
        $speciesArr = Species::select([$key, 'species.created_at', 'users.name'])->join('users', 'species.user_id', 'users.id')->where('oid', $oid)->where('is_approved', 1)->orderBy('version', 'desc')->get()->toArray();
        $isFirst = true;
        $oldData = '';
        for ($i = count($speciesArr) - 1; $i >= 0; $i--) {
            if ($isFirst) {
                $isFirst = false;
            } else {
                if ($speciesArr[$i][$key] == $oldData) {
                    unset($speciesArr[$i]);
                    continue;
                }
            }
            $oldData = $speciesArr[$i][$key];
        }
        $speciesArr = array_values($speciesArr);
        for ($i = 0; $i < count($speciesArr); $i++) {
            //if ($i == 0) $speciesArr[$i]['version'] = 'latest';
            if ($i == count($speciesArr) - 1) $speciesArr[$i]['version'] = 'Original';
            else $speciesArr[$i]['version'] = count($speciesArr) - $i;
        }

        return view('species.history', ['speciesArr' => $speciesArr, 'key' => $key, 'name' => $name]);
    }


    public function historyMultiple($id, $category)
    {
        $oid = Species::find($id)->oid;
        $speciesArr = Species::all()->where('oid', $oid)->toArray();
        $schemeArr = Scheme::select(['key', 'name'])->where('category', $category)->get()->toArray();
        $userArr = User::all()->toArray();
        return view('species.historyMultiple', ['id' => $id, 'speciesArr' => $speciesArr, 'category' => $category, 'schemeArr' => $schemeArr, 'userArr' => $userArr]);
    }


}
