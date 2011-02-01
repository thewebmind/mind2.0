Mind.Plugins.mNotes= {
	/* needed methods */
	Run: function(){
		//this.Save('', '');
	},
	Load: function(){
		
	},
	/***************************/
	Exclude: function(fileName){
		if(confirm('Are you sure you want to delete this file?'))
		{
			this.Unlink(fileName);
			this.Init();
		}
	},
	Init: function(){
		var x= Mind.Plugins.mNotes.MkDir(Mind.Project.attributes.name); // if the directory does not exist, it created it.
		if(!x)
			alert('An error Ocurred, please, verify the permissions of your plugins directory');
		
		// let's list all the files we have in the DATA/[name of the current project] directory, inside our plugind dir.
		var list= Mind.Plugins.mNotes.List(Mind.Project.attributes.name);
		if(!list)
			document.getElementById('savedNotes').innerHTML= 'No Files/Notes to list';
		else{
				document.getElementById('savedNotes').innerHTML= '';
				for(file in list) // here, we are listing all the files
				{
					document.getElementById('savedNotes').innerHTML+= "Link to "+list[file].type+": <a href='"+list[file].address+"' target='_quot'>"+list[file].name+'</a>';
					document.getElementById('savedNotes').innerHTML+= "<img src='"+this.src+"/del.gif' style='margin-left:8px;cursor:pointer' onclick='Mind.Plugins.mNotes.Exclude(this.getAttribute(\"fileName\"))' fileName='"+Mind.Project.attributes.name+'/'+list[file].name+"'/>";
					document.getElementById('savedNotes').innerHTML+= "<br/>";
				}
			}
		
		// here, we'll get the content of the file notes.txt
		var notes= Mind.Plugins.mNotes.LoadFile(Mind.Project.attributes.name+'/notes.txt');
		
		if(notes)
		{
			document.getElementById('savedNotes').innerHTML+= '<hr/><pre>'+notes.content+'</pre>';
		}
	}
}



/*
	os metodos Save, Unlink, MkDir, List e LoadFile ser�o adicionados ao plugin, pelo proprio Mind, sendo assim, s�o palavras reservadas
	Assinaturas:
	
	
	function Save(file_pach, content [, flag]):boolean;
	Retorno: true caso funcione, false caso algum erro ocorra
	Parametros:
		file_path: endere�o, incluindo diret�rio para salvar o arquivo, caso nao exista, ser� criado
		content: conte�do a ser salvo no arquivo
		flag: true pra concatenar content ao conteudo do arquivo, false, para substituir todo o conte�do, caso o arquivo j� exista
	
	function Unlink(file_pach):boolean;
	Retorno: true caso funcione, false caso algum erro ocorra
	Parametros:
		file_path: endere�o, incluindo diret�rio, do arquivo a ser removido
		
	function MkDir(dir_pach):boolean;
	Retorno: true caso funcione, false caso algum erro ocorra
	Parametros:
		dir_pach: endere�o, incluindo diret�rio pais, de onde o novo diret�rio deve ser criado
		
	function List(dir_pach):ObjectCollection;
	Retorno: ObjectCollection[
									Object[
											name:nome do arquivo ou diret�rio,
											type:directory ou file,
											address:endere�o absoluto do arquivo
										  ]
							 ]
	Parametros:
		dir_pach: endere�o, incluindo diret�rio pais, do diret�rio cujos arquivos ser�o listado
	
	function LoadFile(file_pach):Object;
	Retorno: Object[
						name:nome do arquivo,
						address:endere�o completo do arquivo,
						size:tamanho do arquivo,
						content:conte�do do arquivo,
						lastChange:data da ultima modifica��o do arquivo
				   ]
	Parametros:
		file_path: endere�o, incluindo diret�rio, do arquivo a ser carregado
*/