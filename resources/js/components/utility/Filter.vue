<template>
  <div>

	<utility-top-menu>
		<button
			v-for="(item, index) in this.items"
			@click="toggleFilterDisplay" 
			:key="index"
			:name="item.listName"
			class="btn btn-secondary m-4">
			{{item.list.displayName}}
		</button>
	</utility-top-menu>


	<utility-dropdown
	  v-for="(item, index) in this.displayedItems"
	  :key="index"
	  :items="item.list.content"
	  :keyName="item.keyName"
	>
	</utility-dropdown>
	
  </div>
</template>

<script>
import UtilityDropdown from './DropDown.vue'
import UtilityTopMenu from './TopMenu.vue';
export default {
	components: {UtilityDropdown, UtilityTopMenu},
	props: {
		items: Array,
		filterToShow: String,
	},
	computed: {
		displayedItems: function() {
			return this.items.filter(item => item.listName === this.filterToShow)
		}
	},
	methods: {
		toggleFilterDisplay(event) {
			this.filterToShow = this.filterToShow === event.target.name 
				? null 
				: event.target.name;
		}
	}
}
</script>

<style>

</style>
