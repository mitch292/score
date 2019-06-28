<template>
  <div>
	<utility-dropdown
	  v-for="(item, index) in this.displayedItems"
	  :key="index"
	  :items="item.list"
	  :keyName="item.keyName"
	>
	</utility-dropdown>
  </div>
</template>

<script>
import UtilityDropdown from './DropDown.vue'
export default {
	components: {UtilityDropdown},
	props: {
		items: Array,
		filterToShow: String,
	},
	computed: {
		displayedItems: function() {
			return this.items.filter(item => item.listName === this.filterToShow)
		}
	}
}
</script>

<style>

</style>
