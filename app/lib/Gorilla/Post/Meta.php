<?php namespace Gorilla\Post;

use Gorilla\Post;

class Meta {

	protected $post;

	public function __construct(Post $post)
	{
		$this->post = $post;
	}

	public function all()
	{
		return array(
			'title'       => $this->title(),
			'keywords'    => $this->keywords(),
			'description' => $this->description(),
		);
	}

	public function title()
	{
		return strip_tags($this->post->title);
	}

	public function keywords()
	{
		return $this->extractKeywords();
	}

	public function description()
	{
		return strip_tags($this->post->parsed_content);
	}

	public function render($key = null)
	{
		$meta = is_null($key) ? $this->all() : array($key => $this->{$key}());

		foreach ($meta as $key => $value)
		{
			$meta[$key] = "<meta name=\"{$key}\" content=\"{$value}\">";
		}

		return implode("\n\t\t", $meta);
	}

	public function __toString()
	{
		return $this->render();
	}


	/**
	 * Extract best Keywords from post content
	 *
	 * @var $minWordLen         Min words length
	 * @var $minWordOccurrences Min word occurences
	 * @var $maxWords           Max words number
	 * @var $titleIncrement     Word ranking if in the title
	 * @var $asArray            Return as array
	 * 
	 * @return mixed
	 */
	protected function extractKeywords($minWordLen = 3, $minWordOccurrences = 2, $maxWords = 8, $titleIncrement = 5, $asArray = false)
	{
		$content = strip_tags($this->post->parsed_content);
		$content = str_replace(array("?","!",";","(",")",":","[","]","\n","\r"), " ", strtolower($content));

		// Content words array
		$words = str_word_count($content, 1);
		$words = array_filter($words, function($word) use ($minWordLen)
		{
			return mb_strlen($word) >= $minWordLen;
		});

		// Common words Dictionary ( http://www.ranks.nl/resources/stopwords.html )
		$commonWordsArr = array(
			'it' => array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z","ad","ed","il","lo","la","gli","le","un","uno","una","di","da","in","su","per","con","tra","fra","al","allo","alla","ai","agli","alle","dal","dallo","dalla","dai","dagli","dalle","del","dello","della","dei","degli","delle","nel","nello","nella","nei","negli","nelle","sul","sullo","sulla","sui","sugli","sulle","davanti","dietro","stante","durante","sopra","sotto","salvo","accanto","avanti","verso","presso","contro","circa","intorno","fuori","malgrado","vicino","lontano","dentro","indietro","insieme","assieme","oltre","senza","attraverso","nondimeno","mio","mia","miei","mie","tuo","tua","tuoi","tue","suo","sua","suoi","sue","nostro","nostra","nostri","nostre","vostro","vostra","vostri","vostre","loro","questo","codesto","cotesto","quello","ciò","questa","codesta","cotesta","quella","io","tu","egli","esso","ella","essa","noi","voi","essi","esse","me","mi","te","ti","lui","lei","ce","ci","ve","vi","se","si","ne","che","colui","colei","cui","chi","sono","sei","è","siamo","siete","sarebbe","sarà","essendo","ho","hai","ha","abbiamo","avete","hanno","avrebbe","avrà","avendo","avuto","l'","un'","all","all'","dall","dall'","dell","dell'","sull'","nell","nell'","quell","quell'","c'","v'","po'","può","potrà","potrebbe","potuto","deve","dovrà","dovrebbe","dovuto","due","tre","quattro","cinque","sette","otto","nove","dieci","venti","trenta","quaranta","cinquanta","sessanta","settanta","ottanta","novanta","cento","primo","secondo","terzo","quarto","quinto","sesto","settimo","ottavo","nono","decimo","ma","però","anzi","tuttavia","pure","invece","perciò","quindi","dunque","pertanto","ebbene","orbene","né","neppure","neanche","nemmeno","sia","oppure","ossia","altrimenti","cioè","infatti","invero","difatti","perché","poiché","giacché","quando","mentre","finché","affinché","acciocché","qualora","purché","sebbene","quantunque","benché","nonostante","come","quasi","fuorché","tranne","eccetto","laddove","ah","oh","eh","orsù","urrà","ahimè","suvvia","basta","insomma","così","qui","qua","lì","là","già","allora","prima","dopo","ora","poi","sempre","mai","presto","tardi","intanto","frattanto","talvolta","spesso","molto","troppo","poco","più","meno","assai","niente","nulla","alquanto","altrettanto","anche","perfino","persino","altresì","finanche","abbastanza","almeno","ancora","appunto","attualmente","certamente","comunque","altrove","dove","dovunque","effettivamente","forse","generalmente","inoltre","insufficientemente","inutilmente","naturalmente","no","non","nuovamente","ovunque","ovviamente","piuttosto","precedentemente","probabilmente","realmente","realmente","semplicemente","sì","solitamente","soprattutto","specificamente","successivamente","sufficientemente","veramente","lunedì","martedì","mercoledì","giovedì","venerdì","sabato","domenica","gennaio","febbraio","marzo","aprile","maggio","giugno","luglio","agosto","settembre","ottobre","novembre","dicembre","alcune","alcuni","alcuno","altri","altro","certo","chiunque","ciascuno","molti","nessun","nessuno","ogni","ognuno","parecchi","parecchio","pochi","qualche","qualcosa","qualcuno","qualunque","tanto","tutti","tutto","qual","quale","quali","quanto","anno","bene","cosa","cose","data","esempio","male","scelta","vero","via","aperto","attuale","breve","chiuso","corto","differente","difficile","dissimile","diverso","entrambe","entrambi","esterno","facile","falso","grande","inusuale","inutile","lungo","impossibile","improbabile","insolito","insufficiente","maggiore","maggior","minore","minor","piccolo","pieno","possibile","probabile","pronto","semplice","siffatto","simile","sufficiente","usuale","utile","vuoto","interno","mediante","modo","ovvio","precedente","primi","propri","proprio","prossimo","reale","scelto","soli","solito","solo","soltanto","specifico","stessi","stesso","subito","successivo","super","tale","totale","totali","uguale","uguali","ulteriore","ultimi","ultimo","vari","vario","verso"),
			'en' => array("a","able","about","across","after","all","almost","also","am","among","an","and","any","are","as","at","be","because","been","but","by","can","cannot","could","dear","did","do","does","either","else","ever","every","for","from","get","got","had","has","have","he","her","hers","him","his","how","however","i","if","in","into","is","it","its","just","least","let","like","likely","may","me","might","most","must","my","neither","no","nor","not","of","off","often","on","only","or","other","our","own","rather","said","say","says","she","should","since","so","some","than","that","the","their","them","then","there","these","they","this","tis","to","too","twas","us","wants","was","we","were","what","when","where","which","while","who","whom","why","will","with","would","yet","you","your"),
		);

		// Remove common words ( currently only in English )
		$commonWords = array_get($commonWordsArr, 'en', array());
		$words = array_diff($words, $commonWords);

		// Sort by keywords density
		$keywords = array_count_values($words);
		arsort($keywords);

		// Calculate final keywords
		$finalKeywords = array();
		foreach($keywords as $keyword => $occurences)
		{
			if (str_contains(strtolower($this->post->title), $keyword))
			{
				$occurences += $titleIncrement;
			}

			if ($occurences >= $minWordOccurrences)
			{
				$finalKeywords[$keyword] = $occurences;
			}
		}

		// Re-sort by occurences
		if ( ! empty($finalKeywords))
		{
			arsort($finalKeywords);
			$finalKeywords = array_slice(array_keys($finalKeywords), 0, $maxWords);
		}
		else
		{
			$finalKeywords = $words;
		}

		return $asArray ? $finalKeywords : implode(',', $finalKeywords);
	}

}