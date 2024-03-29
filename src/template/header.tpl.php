<?php
// Copyright 2019 The Inescoin developers.
// - Mounir R'Quiba
// Licensed under the GNU Affero General Public License, version 3.
?><nav class="navbar navbar-expand-lg navbar-light bg-light">
	<div class="container">
		<a class="navbar-brand" href="//inescoin.org">
			<img src="https://res.cloudinary.com/dzfbxltzx/image/upload/v1650293557/Inescoin/logo/Inescoin_logo_couleurs_complet_1_copie_cc1uzu.png" width="120" height="40" alt="Inescoin Explorer">
		</a>

	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

		<div class="collapse navbar-collapse"  id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
	      <li class="nav-item">
	        <a class="nav-link active" href="//explorer.inescoin.org">
	          Explorer
	        </a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="//wallet.inescoin.org">
	          Wallet
	        </a>
	      </li>
	    </ul>
			<?php include $components['search']; ?>
		</div>
	</div>
</nav>
