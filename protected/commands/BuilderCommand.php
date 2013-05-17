<?php
/**
 * BuilderCommand class file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 * @since 2013-05-14
 */

class BuilderCommand extends CConsoleCommand {
	
	private $repo;
	private $until;
	
	/**
	 * @var GitClient
	 */
	private $client;
	
	
	protected function getClient() {
		if ($this->client === null) {
			$this->client = new GitClient($this->repo);
		}
		return $this->client;
	}
	
	
	public function run($args) {
		if (!$this->parseOptions($args)) {
			echo $this->getHelp();
			return 1;
		}
		
		$client = $this->getClient();
		$commitsOld = $commits = $client->listCommitUntil();
		array_shift($commitsOld);
		foreach ($commitsOld as $i => $commitOld) {
			$diff = $this->client->diffCommit($commitOld, $commits[$i]);
			//var_dump($commits[$i]->getTree());
			$this->parseDiffFiles($diff, $commits[$i]);
		}
	}

	protected function parseDiffFiles($diff, $currCommit) {
		if (isset($diff['A'])) {
			foreach ($diff['A'] as $filename) {
				$content = $this->client->fetchContentByPath($currCommit->getTree(), $filename);
				
			}
		}
	}
	
	
	protected function parseOptions($args) {
		list($action, $options, $args)=$this->resolveRequest($args);
		if (!isset($options['repo'])) {
			return false;
		}

		foreach (array('repo', 'until') as $option) {
			if (isset($options[$option])) {
				$this->$option = $options[$option];
			}
		}
		if (!is_string($this->repo) || is_dir($this->repo) === false) {
			printf("Option '--repo' is not a valid path.\n\n");
			return false;
		}
		return true;
	}
	
	public function getHelp() {
		return <<<EOF
USAGE
  yiic builder <options>

DESCRIPTION
  This command build repo raw data to structured record in database.

PARAMETERS

   The following options are available:

   - repo: string, the path of repository which should fetch data from.

   - until: string, commit id of last built.


EOF;
	}
}
