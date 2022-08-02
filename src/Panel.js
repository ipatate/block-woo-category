import { PanelBody, SelectControl } from '@wordpress/components'
import { InspectorControls } from '@wordpress/blockEditor'
import { __ } from '@wordpress/i18n'

const Panel = ({ props }) => {
  const { attributes, setAttributes, woo_categories } = props
  const { category } = attributes
  const options = woo_categories
    ? woo_categories.map((e) => ({ label: e.name, value: e.id }))
    : []
  return (
    <InspectorControls>
      <PanelBody title={__('Settings', 'gm-woo-category')}>
        <SelectControl
          label={__('Category', 'gm-woo-category')}
          value={category}
          options={options}
          onChange={(content) => setAttributes({ category: content })}
        />
      </PanelBody>
    </InspectorControls>
  )
}

export default Panel
