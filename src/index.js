import { registerBlockType } from '@wordpress/blocks'
import { withSelect } from '@wordpress/data'
import ServerSideRender from '@wordpress/server-side-render'
import { __ } from '@wordpress/i18n'
import { useBlockProps } from '@wordpress/block-editor'
import Panel from './Panel'

registerBlockType('goodmotion/block-woo-category', {
  title: __('Gm Woo Category', 'gm-woo-category'),
  description: __('Block for display woocommerce category.', 'gm-woo-category'),
  icon: 'buddicons-community',
  category: 'goodmotion-blocks',
  example: {},
  attributes: {
    category: {
      type: 'string',
    },
  },
  edit: withSelect((select) => {
    return {
      // products categories list
      woo_categories: select('core').getEntityRecords(
        'taxonomy',
        'product_cat',
        { per_page: 100 },
      ),
    }
  })((props) => {
    const blockProps = useBlockProps()
    return (
      <div {...blockProps}>
        <Panel props={props} />
        <ServerSideRender
          block="goodmotion/block-woo-category"
          attributes={props.attributes}
        />
      </div>
    )
  }),
  // save
})
