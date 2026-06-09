<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$args = array(
	'role'    => 'vendor',
	'orderby' => 'user_nicename',
	'order'   => 'ASC',
);

$users = get_users( $args );

?>

<div class="wrap">

	<h1><?php esc_html_e( 'Vendor Listing', 'loe-all-vendors' ); ?></h1>

	<table class="wp-list-table widefat fixed striped">

		<thead>
			<tr>
				<th><?php esc_html_e( 'Vendor Name', 'loe-all-vendors' ); ?></th>
				<th><?php esc_html_e( 'Email', 'loe-all-vendors' ); ?></th>
				<th><?php esc_html_e( 'Country', 'loe-all-vendors' ); ?></th>
				<th><?php esc_html_e( 'Products', 'loe-all-vendors' ); ?></th>
				<th><?php esc_html_e( 'Registered On', 'loe-all-vendors' ); ?></th>
				<th><?php esc_html_e( 'Actions', 'loe-all-vendors' ); ?></th>
			</tr>
		</thead>

		<tbody>

		<?php if ( ! empty( $users ) ) : ?>

			<?php foreach ( $users as $user ) : ?>

				<?php
				$country      = get_user_meta( $user->ID, 'country', true );
				$product_count = count_user_posts( $user->ID, 'product' );

				$delete_url = wp_nonce_url(
					admin_url(
						'users.php?action=delete&user=' . $user->ID
					),
					'delete-user_' . $user->ID
				);
				?>

				<tr>

					<td>
						<?php echo esc_html( $user->display_name ); ?>
					</td>

					<td>
						<?php echo esc_html( $user->user_email ); ?>
					</td>

					<td>
						<?php echo esc_html( $country ); ?>
					</td>

					<td>
						<?php echo esc_html( $product_count ); ?>
					</td>

					<td>
						<?php echo esc_html( $user->user_registered ); ?>
					</td>

					<td>

						<a
							href="<?php echo esc_url( get_edit_user_link( $user->ID ) ); ?>"
							class="button button-small"
						>
							<?php esc_html_e( 'Edit', 'loe-all-vendors' ); ?>
						</a>

						<a
							href="<?php echo esc_url( $delete_url ); ?>"
							class="button button-small button-link-delete"
							onclick="return confirm('Are you sure?');"
						>
							<?php esc_html_e( 'Delete', 'loe-all-vendors' ); ?>
						</a>

					</td>

				</tr>

			<?php endforeach; ?>

		<?php else : ?>

			<tr>
				<td colspan="6">
					<?php esc_html_e( 'No vendors found.', 'loe-all-vendors' ); ?>
				</td>
			</tr>

		<?php endif; ?>

		</tbody>

	</table>

</div>
