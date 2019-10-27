<?php if (!empty($domain)) { ?>
<div class="card mt-4">
  <div class="card-header">
    <i class="fa fa-globe" aria-hidden="true"></i> Domain
  </div>
  <div class="card-body">
    <table class="table table-responsive table-striped w-100">
        <tbody>
            <tr>
                <td>Name</td>
                <td class="fixedfont"><?php echo $domain['url'] ?></td>
            </tr>
            <tr>
                <td>Hash</td>
                <td class="fixedfont"><?php echo $domain['hash'] ?></td>
            </tr>
            <tr>
                <td>Owner Address</td>
                <td class="fixedfont">
                	<a href="?wallet=<?php echo $domain['ownerAddress']; ?>">
                		<?php echo $domain['ownerAddress']; ?>
                	</a>
                </td>
            </tr>
            <tr>
                <td>Owner Public Key</td>
                <td class="fixedfont"><?php echo $domain['ownerPublicKey']; ?></td>
            </tr>
            <tr>
                <td>Signature</td>
                <td class="fixedfont"><small><?php echo $domain['signature']; ?></small></td>
            </tr>
            <tr>
                <td>Height [start]</td>
                <td class="fixedfont">
                    <a href="?block-height=<?php echo $domain['blockHeight']; ?>">
                        <?php echo $domain['blockHeight']; ?>
                    </a>
                </td>
            </tr>
            <tr>
                <td>Height [end]</td>
                <td class="fixedfont">
                    <?php echo $domain['blockHeightEnd']; ?>
                </td>
            </tr>
            <tr>
                <td>Transaction [create]</td>
                <td class="fixedfont">
                    <a href="?transaction=<?php echo $domain['transactionHash']; ?>">
                        <?php echo $domain['transactionHash']; ?>
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
  </div>
</div>

<?php if (isset($website['body'])): ?>
<div class="card mt-4">
  <div class="card-header">
    Website body (base64)
  </div>
  <div class="card-body">
  	<?php echo $website['body']; ?>
  </div>
</div>
<?php endif; ?>


<div class="card mt-4">
  <div class="card-header">
    Transactions <span class="badge badge-info"><?php echo count($domain['transactions']) ?></span>
  </div>
  <div class="card-body">
    <table class="table table-responsive table-striped w-100">
        <tbody>
          <tr>
            <th>Height</th>
            <th>Amount</th>
            <th>Fee</th>
            <th>Hash</th>
            <th>From</th>
            <th>Action</th>
          </tr>
          <?php foreach ($domain['transactions'] as $transaction): ?>
            <tr>
              <td class="align-center">
              <?php echo $transaction['blockHeight']; ?>
              </td>
              <td class="align-center"><?php echo ($transaction['amount'] / 1000000000); ?></td>
              <td class="align-center"><?php echo ($transaction['fee'] / 1000000000); ?></td>
              <td class="align-center">
                <a href="?transaction=<?php echo $transaction['hash']; ?>">
                  <div class="truncate"><?php echo $transaction['hash']; ?></div>
                </a>
              </td>
              <td class="align-center">
                <a href="?wallet=<?php echo $transaction['from']; ?>">
                  <?php echo $transaction['from']; ?>
                </a>
              </td>
              <td class="align-center"><?php echo $transaction['urlAction']; ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
    </table>
  </div>
</div>
<?php } else { ?>
<div class="alert alert-danger text-center mt-4">
     <i class="fa fa-exclamation-triangle"></i> Domain not found or deleted.
</div>
<?php } ?>
