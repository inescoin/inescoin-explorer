<div class="card mt-4">
  <div class="card-header">
    Transfer Information
  </div>
  <div class="card-body">
    <table class="table table-responsive table-striped w-100">
        <tbody>
            <tr>
                <th>To</th>
                <th>Amount</th>
                <th>Hash</th>
                <th>Nonce</th>
            </tr>
            <tr>
                <td class="align-center">
                    <a href="?wallet=<?php echo $transfer['transfer']['to']; ?>">
                        <?php echo $transfer['transfer']['to']; ?>
                    </a>
                </td>
                <td class="align-center"><?php echo ($transfer['transfer']['amount'] / 1000000000); ?></td>
                <td class="align-center" title="<?php echo $transfer['transfer']['hash']; ?>"><div class="truncate"><?php echo $transfer['transfer']['hash']; ?></div></td>
                <td class="align-center" title="<?php echo $transfer['transfer']['nonce']; ?>"><div class="truncate"><?php echo $transfer['transfer']['nonce']; ?></div></td>
            </tr>
        </tbody>
    </table>
  </div>
</div>

<div class="card mt-4">
  <div class="card-header">
    Transaction Information
  </div>
  <div class="card-body">
    <table class="table table-responsive table-striped w-100">
        <tbody>
            <tr>
                <td>Date</td>
                <td class="fixedfont"><?php echo $transfer['transaction']['createdAt']['date']; ?> <?php echo date($transfer['transaction']['createdAt']); ?></td>
            </tr>
            <tr>
                <td>From</td>
                <td class="fixedfont">
                    <a href="?wallet=<?php echo $transfer['transaction']['from'] ?>">
                        <?php echo $transfer['transaction']['from']; ?>
                    </a>
                </td>
            </tr>
            <tr>
                <td>Hash</td>
                <td class="fixedfont">
                    <a href="?transaction=<?php echo $transfer['transaction']['hash'] ?>">
                        <?php echo $transfer['transaction']['hash']; ?>
                    </a>
                </td>
            </tr>
            <tr>
                <td>Height</td>
                <td class="fixedfont">
                    <a href="?block-height=<?php echo $transfer['transaction']['blockHeight']; ?>">
                        <?php echo $transfer['transaction']['blockHeight']; ?>
                    </a>
                </td>
            </tr>
            <tr>
                <td>Amount</td>
                <td class="fixedfont"><?php echo ($transfer['transaction']['amount'] / 1000000000); ?></td>
            </tr>
            <tr>
                <td>Fee</td>
                <td class="fixedfont"><?php echo $transfer['transaction']['fee']; ?></td>
            </tr>
            <tr>
                <td>Config Hash</td>
                <td class="fixedfont"><?php echo $transfer['transaction']['configHash']; ?></td>
            </tr>
            <tr>
                <td>Coinbase</td>
                <td class="fixedfont"><?php echo !$transfer['transaction']['coinbase'] ? 'false' : 'true'; ?></td>
            </tr>
            <?php if(!$transfer['transaction']['coinbase']): ?>
            <tr>
                <td>Public Key</td>
                <td class="fixedfont"><?php echo $transfer['transaction']['publicKey']; ?></td>
            </tr>
            <tr>
                <td>Signature</td>
                <td class="fixedfont"><?php echo $transfer['transaction']['signature']; ?></td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
  </div>
</div>
